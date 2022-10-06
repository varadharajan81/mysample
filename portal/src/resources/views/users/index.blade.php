@extends('layouts.default')

@extends('themes.title')

@section('content')

<div class="page-inner">
	@include('themes.innerheader')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Add Row</h4>
						<div class="ml-md-auto py-2 py-md-0">
							<a href="" class="btn btn-danger btn-border btn-round mr-2"><i class="fa fa-plus"></i> Add User</a>
                    	</div>
                    </div>
                </div> -->

				@include('themes.listheader')

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
											<th>#</th>
				                            <th class="text-center">NAME</th>
				                            <th class="text-center">MOBILE</th>
				                            <th class="text-center">STATUS</th>
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach($users as $key => $user)
                                        <tr>
											<td scope="row" class="align-center">  {{ ($users->currentpage()-1) * $users->perpage() + $key + 1 }}</td>
				                            <td class="text-center">{{ $user['name'] }}</td>
				                            <td class="text-center">{{ $user['mobile'] }}</td>
				                            <td class="text-center"><span class="label bg-{{ ($user['status'] == 1 ) ? 'green' : 'red' }}"> {{ ($user['status'] == 1 ) ? 'Approved' : 'Denied' }}</span></td>
                                            <td class="text-center">
                                                <div class="form-button-action">
													<a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Users" href="{{ url('users/' . $user['id'] . '/edit') }}">
														<i class="fa fa-edit"></i>
													</a>
													<form action="{{ url('users' , $user->id) }}" method="POST" >
					                                    {{ csrf_field() }}
					                                    <input type="hidden" name="_method" value="DELETE" />
														<button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger js-delete" data-original-title="Remove Users">
															<i class="fa fa-times"></i>
														</button>
					                                </form>
                                                </div>
                                            </td>
                                        </tr>
										@endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
								<div class="col-sm-12 col-md-5">
									<div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">
										Page {{ $users->currentPage() }} of {{ $users->lastPage() }}, showing {{ $users->count() }} records out of {{ $users->total() }} total
									</div>
								</div>
								<div class="col-sm-12 col-md-7">
									<div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
										{{ $users->render() }}
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
