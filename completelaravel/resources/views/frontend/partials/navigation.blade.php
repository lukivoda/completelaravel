<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="sumit kumar">
    <title>blog</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link href="{{asset("blueimp-gallery.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("style.css")}}" rel="stylesheet" type="text/css">
    <!-- <script src="https://use.fontawesome.com/07b0ce5d10.js"></script> -->


</head>

<body>

<div class="container">
    <nav class="navbar navbar-inverse">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('index')}}">aquila</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="{{route('gallery')}}">Gallery</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right searchBox">
                <form id="searchForm" class="navbar-form navbar-left">
                   {{csrf_field()}}
                    <div class="input-group">
                        <input name="search" id="search" type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button id="searchBtn" class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </ul>
        </div>
    </nav>
</div>