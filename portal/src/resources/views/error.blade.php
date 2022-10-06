@extends('layouts.app')

@section('title', 'API Documentation')

@section('content')
<section class="content-header">
    <h1>API Documentation
        <small>Current version 1.0.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Here</li>
    </ol>
</section>

<!-- Main content -->
<div class="content body">
    <section id="categories" class="content">
        <h2 class="page-header">Error Codes & Responses</h2>
        <h3> HTTP Status Codes</h3>
        <p class="lead">The API attempts to return appropriate <a href="http://en.wikipedia.org/wiki/List_of_HTTP_status_codes" rel="nofollow">HTTP status codes</a> for every request.</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Text</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>200</th>
                    <td>OK</td>
                    <td>Success!</td>
                </tr>
                <tr>
                    <th>304</th>
                    <td>Not Modified</td>
                    <td>There was no new data to return.</td>
                </tr>
                <tr>
                    <th>400</th>
                    <td>Bad Request</td>
                    <td>The request was invalid or cannot be otherwise served. An accompanying error message will explain further. In API v1.1, requests without authentication are considered invalid and will yield this response.</td>
                </tr>
                <tr>
                    <th>401</th>
                    <td>Unauthorized</td>
                    <td>Authentication credentialswere missing or incorrect.</td>
                </tr>
                <tr>
                    <th>403</th>
                    <td>Forbidden</td>
                    <td>It has been refused or access is not allowed. Other reasons for this status being returned are listed alongside the response codes in the table below.</td>
                </tr>
                <tr>
                    <th>404</th>
                    <td>Not Found</td>
                    <td>The URI requested is invalid or the resource requested, such as a user, does not exists. Also returned when the requested format is not supported by the requested method.</td>
                </tr>
                <tr>
                    <th>406</th>
                    <td>Not Acceptable</td>
                    <td>Returned by the Search API when an invalid format is specified in the request.</td>
                </tr>
                <tr>
                    <th>410</th>
                    <td>Gone</td>
                    <td>This resource is gone. Used to indicate that an API endpoint has been turned off.</td>
                </tr>
                <tr>
                    <th>500</th>
                    <td>Internal Server Error</td>
                    <td>Something is broken.</td>
                </tr>
                <tr>
                    <th>502</th>
                    <td>Bad Gateway</td>
                    <td>Server is down or being upgraded.</td>
                </tr>
                <tr>
                    <th>503</th>
                    <td>Service Unavailable</td>
                    <td>The API servers are up, but overloaded with requests. Try again later.</td>
                </tr>
                <tr>
                    <th>504</th>
                    <td>Gateway timeout</td>
                    <td>The API servers are up, but the request couldn’t be serviced due to some failure within our stack. Try again later.</td>
                </tr>
            </tbody>
        </table>
    </section>
</div>
@endsection