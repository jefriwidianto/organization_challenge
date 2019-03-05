@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">View Person</div>

                <div class="panel-body">
                        <?php foreach ($person as $key) {?>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-5 ">
                                <div class="w3-third">
                                  <div class="w3-card">
                                    <img src="/storage/avatar/{{ $key->avatar }}" style="width:150px">
                                    <div class="w3-container">
                                      <h4>{{ $key->name }}</h4>
                                    </div>
                                  </div>
                                </div>
                            </div> 
                        </div>
                        
                        <blockquote>
                        <table border="0" bgcolor="white">
                            <tr>
                                <td>Email: </td>
                                <td>{{ $key->email_person }}</td>
                            </tr>
                            <tr>
                                <td>Phone: </td>
                                <td>{{ $key->phone_person }}</td>
                            </tr>
                        </table>
                        </blockquote>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="" aria-expanded="true">
                                    Organization
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <table border="0" bgcolor="white">
                                        <tr>
                                            <td>Name: </td>
                                            <td>{{ $key->name_orgz }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone: </td>
                                            <td>{{ $key->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email: </td>
                                            <td>{{ $key->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Website: </td>
                                            <td>{{ $key->phone }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
