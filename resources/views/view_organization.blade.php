@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">View Organization</div>

                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5 col-md-offset-5 ">
                                <div class="w3-third">
                                  <div class="w3-card">
                                    <img src="/storage/logo/{{ $organization->logo }}" style="width:150px">
                                    <div class="w3-container">
                                      <h4>{{ $organization->name_orgz }}</h4>
                                    </div>
                                  </div>
                                </div>
                            </div> 
                        </div>
                        
                        <blockquote>
                        <table border="0" bgcolor="white">
                            <tr>
                                <td>Email: </td>
                                <td>{{ $organization->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone: </td>
                                <td>{{ $organization->phone }}</td>
                            </tr>
                            <tr>
                                <td>Website: </td>
                                <td>{{ $organization->website }}</td>
                            </tr>
                            <tr>
                                <td>Company: </td>
                                <td>{{ $organization->company }}</td>
                            </tr>
                        </table>
                        </blockquote>
                        

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="" aria-expanded="true">
                                    List Person
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                @if(count($person) >= 1)
                                    <?php foreach ($person as $key1) {?>
                                    
                                    <table border="0" bgcolor="white">
                                        <tr>
                                            <td>Name: </td>
                                            <td>{{ $key1->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone: </td>
                                            <td>{{ $key1->phone_person }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email: </td>
                                            <td>{{ $key1->email_person }}</td>
                                        </tr>
                                    </table><br />

                                    <?php } ?>
                                @else 
                                    <i><font color="red"> Not Set </font></i>
                                @endif
                                    
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
