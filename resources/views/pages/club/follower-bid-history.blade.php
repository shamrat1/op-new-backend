@extends('layouts.master-auth')
@section('title','My Follower - {{ $user->username }}')
@section('style')

    <style type="text/css">
        .history{
              background-color: #10440b;
    border-bottom: 2px solid #000;
          padding-top: 20px;
          padding-bottom: 60px;
        }
        .table{color: #ddd;}
        .primary{
          color: #fff;
          background-color: #0c4aff;
          border-color: #64b000;
          border: 0;
          padding-left: 80px;
          padding-right: 80px;
          margin-top: 20px;
          padding-top: 20px;
          padding-bottom: 20px;
          font-weight: bold;
        }
        .primary:hover{
          color: #000;
          background-color: #082578;
        }
        .hello{
            color: #fff;
          }
        .userName{
            color: #00f1b9; font-size: 20px;
          }
        .profilebtn:hover{
          color: #fff;
          background-color: #0cb4e6;
        }

       /*responsive start*/
        
 @media(max-width: 320px){h2.hello {
    font-size: 20px;
}p.userName {
    font-size: 15px;
}table.table {
    font-size: 12px;
}
}
 @media(min-width: 320px) and (max-width: 480px){h2.hello {
    font-size: 20px;
}p.userName {
    font-size: 15px;
}table.table {
    font-size: 12px;
}
}
 @media (min-width: 480px) and (max-width: 580px){h2.hello {
    font-size: 20px;
}p.userName {
    font-size: 15px;
}table.table {
    font-size: 12px;
}
}
 @media (min-width: 580px) and (max-width: 768px){h2.hello {
    font-size: 20px;
}p.userName {
    font-size: 15px;
}table.table {
    font-size: 12px;
}
}
 @media (min-width: 768px) and (max-width: 940px){
 @media (min-width: 940px) and (max-width: 1030px){
 @media (min-width: 1031px) and (max-width: 1199px){
 @media(min-width: 1199px) and (max-width: 1330px){

   
    </style>
@endsection
