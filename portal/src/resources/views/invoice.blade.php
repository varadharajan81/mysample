<html>
<head>
	<style>
		@page *{
			margin-top: 0cm;
			margin-bottom: 0cm;
			margin-left: 0cm;
			margin-right: 0cm;
		}
		.title {
			text-align: center;
			font-size:10pt;
		}
		p.subtitle {
			text-align: center;
			font-size:7pt;
		}
		p {
			text-align: left;
			font-size:6pt;
		}
		.p10 {
			padding:10px !important;
			padding-left: 0px !important;
		}
		.p5 {
			padding:5px !important;
			padding-left: 0px !important;
		}
		.red {
			text-align: left;
			font-size:7pt;
			/*color: #F00;*/
		}
		.text-center {
			text-align: left;
			font-size:7pt;
			text-align: center;
		}
		p.item {
			text-align: left;
			font-size:6.3pt;
		}
		p.item2 {
			text-align: left;
			font-size:7pt;
		}
		.bold {
			font-size:8pt;
		}
		p.packing {
			text-align: center;
			margin: 35pt;
			font-size:8pt;
		}
		p.total {
			text-align: center;
			font-size:10pt;
		}
		p.agenttxt {
			text-align: left;
			font-size:6pt;
		}
		.borderbottom {
			border-bottom: 0.5px solid black;
		}
		.bordertop {
			border-top: 0.5px solid black;
		}
		.txt-muted {
			text-align: left;
			font-size:7pt;
		}
		</style>
	</head>
	<body>
		<div>
				<div style="clear:both;">
					<p class="title">Title</p>
					<p class="subtitle">Address Line 1</p>
					<p class="subtitle">Address Line 2</p>
					<p class="subtitle">Ph: 0000 000000</p>
				</div>
				<div class="p5 borderbottom bordertop" style="clear:both;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><p>Customer: <span class="bold">{{ Str::studly($order['user']['name']) }} ({{ $order['user']['mobile'] }})</span></p></td>
						</tr>
						<tr>
							<td><p>Address: #{{ $order['user']['user_address']['doorno'] }}, {{ $order['user']['user_address']['street'] }}, {{ $order['user']['user_address']['pincode'] }}</p></td>
						</tr>
						<tr>
							<td><p>Landmark: {{ $order['user']['user_address']['landmark'] }}</p></td>
						</tr>
					</table>
				</div>
				<div class="p5" style="clear:both;" align="left">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" style="text-align:left;">
						<tr>
							<td colspan="2"><p>Invoice No: {{ $order['invoice_no'] }}</p></td>
						</tr>
						<tr>
							<td><p>Date: {{ $order['created_on']->format('d/m/Y') }}</p></td>
							<td align="right"><p>Time: {{ $order['created_on']->format('h:m A') }}</p></td>
						</tr>
					</table>
				</div>
				<div class="pd5" style="clear:both;">
					<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr style="">
							<td style="vertical-align:middle; width:5%; height:16pt;" class="borderbottom bordertop"><p>No</p></td>
							<td style="vertical-align:middle; width:54%;" class="borderbottom bordertop" align="center"><p>Particulars</p></td>
							<td style="vertical-align:middle; width:11%;" class="borderbottom bordertop" align="right"><p>Rate</p></td>
							<td style="vertical-align:middle; width:11%;" class="borderbottom bordertop" align="right"><p>MRP</p></td>
							<td style="vertical-align:middle; width:7%;" class="borderbottom bordertop" align="right"><p>Qty</p></td>
							<td style="vertical-align:middle; width:12%;" class="borderbottom bordertop" align="right"><p>Amount</p></td>
						</tr>
						@foreach($order['order_loans'] as $key => $order_product)
						<tr>
							<td style="height:16pt;"><p class="item">{{ $key +1 }}</p></td>
							<td align="left"><p style="text-align:left;" class="item2">
								@foreach(explode(',',$order_product['name']) as $keyp => $name)
									@if($keyp == 0){{ $name }} @endif
 								@endforeach
							</p></td>
							<td align="right"><p style="text-align:right;" class="item">{{ number_format($order_product['loan_amount'], 2) }}</p></td>
							<td align="right"><p style="text-align:right;" class="item">{{ number_format($order_product['mrp'], 2) }}</p></td>
							<td align="right"><p style="text-align:right;" class="item">{{ $order_product['quantity'] }}</p></td>
							<td align="right"><p style="text-align:right;" class="item">{{ number_format($order_product['total'], 2) }} </p></td>
						</tr>
						@endforeach
					</table>
				</div>
				<div class="bordertop">
					<table width="100%">
						<tr>
							<td><p class="item">Total Qty: {{ $order->quantity }}</p></td>
							<td align="right">
								<table width="75%">
									<tr>
										<td><p class="item">Total Value</p></td>
										<td align="right"><p class="item">{{ number_format($order['total'], 2) }}</p></td>
									</tr>
									<tr>
										<td><p class="item">Rounding off</td>
										<td align="right"><p class="item">{{ number_format(round($order['total']) - $order['total'], 2) }}</p></td>
									</tr>
									<tr>
										<td><p class="item">Net Value</p></td>
										<td align="right"><p class="item">{{ number_format(round($order['total']), 2) }}</p></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div class="borderbottom bordertop">
					<p>Mode of Payment: Cash on Delivery</p>
					<p class="red">Today’s Savings Rs.{{ round($order['savings']) }}/-</p>
					<p class="total">Rs.{{ round($order['total']) }}/-</p>
					<p class="text-center">(Rupees {{ $order->convert_number_to_words(round($order['total'])) }} Only)</p>
				</div>
				<div>
					<p class="agenttxt">CreditManager Name: Mr.{{ $order['agent']['name'] }} ({{ $order['agent']['mobile'] }})</p>
				</div>
				<div>
					<p class="total">Thank You....</p>
				</div>
		</div>
	</body>
</html>
