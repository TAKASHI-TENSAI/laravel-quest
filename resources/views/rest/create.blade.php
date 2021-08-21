<!DOCTYPE html>
<html lang="ja">
    <head>
        
        <meta charset="utf-8">
        <title>YouTubeまとめ×SNS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
        
    </head>
    <body>
        
        <div class="container">
            
            @include('commons.error_messages')
            
            <h2 class="mt-5">動画を登録する</h2>
        
            {!! Form::open(['route'=>'rest.store']) !!}
                <div class="form-group mt-5">
                    
                    {!! Form::label('url','新規登録YouTube動画 "ID" を入力する',['class'=>'text-success']) !!}
                        <br>例) 登録したいYouTube動画のURLが&thinsp; <span>https://www.youtube.com/watch?v=-bNMq1Nxn5o なら</span>
                        <div>&emsp;&emsp; "v="の直後にある &thinsp;"<span class="text-success">-bNMq1Nxn5o</span>" を入力</div>
                    {!! Form::text('url',null,['class'=>'form-control']) !!}
                    
                    {!! Form::label('comment','登録動画へのコメント',['class'=> 'mt-3']) !!}
                    {!! Form::text('comment',null,['class'=>'form-control']) !!}
                    
                    {!! Form::submit('新規登録する？',['class'=> 'button btn btn-primary mt-5 mb-5']) !!}
                    
                </div>
            {!! Form::close() !!}
            
            <h2 class="mt-5 mb-5">動画を削除する</h2>
            
                @foreach ($movies as $key => $movie)
                    
                    <p>動画ID: {{ $movie->id }}  URL: {{ $movie->url }}  コメント: {{ $movie->comment }}</p>
                    
                    {!! Form::open(['route' => ['rest.destroy', $movie->id], 'method' =>'delete']) !!}
                            {!! Form::submit('この動画を削除する？', ['class' => 'button btn btn-danger']) !!}
                    {!! Form::close() !!}
                    
                @endforeach
        
           
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        
    </body>
    
</html>