    @if($page->list_type == 0)
    <div class="posts-blog row" style="padding-right: 60px;">
    @foreach($newslist as $news)
        <div class="news-blog">
            <a class="row" href="{{asset('news/'.$news->id)}}">
            <div class="col-sm-4">
                <div class="thumb d-block w-100" style="background-image: url('{{asset(str_replace("images","uploads/medium/",$news->image))}}');" title="{{$news->title}}">
                </div>
            </div>
            <div class="col-sm-8">
                <h2>{{$news->title}}</h2>
                <div class="intro-text">{{mb_substr($news->short_content, 0, 350)}}...</div>
                <span class="create_date"><i class="far fa-clock"></i> {{$news->created_at->format('Y-m-d')}}</span>
            </div>
            </a>
        </div>
    @endforeach
    </div>
    @elseif($page->list_type == 1)
    <div class="posts-blog row">
        @foreach($newslist as $news)
            <div class="news-blog-4 col-sm-4">
                <a href="{{asset('news/'.$news->id)}}">
                        <div class="thumb d-block w-100" style="background-image: url('{{asset(str_replace("images","uploads/medium/",$news->image))}}');" title="{{$news->title}}">
                        </div>
                        <span class="create_date"><i class="far fa-clock"></i> {{$news->created_at->format('Y-m-d')}}</span>
                        <h2>{{mb_substr($news->title, 0, 56)}}...</h2>
                </a>
            </div>
        @endforeach
    </div>
    @else
    <div class="posts-blog row">
        @foreach($newslist as $news)
            <div class="news-blog-3 col-sm-3">
                <a href="{{asset('news/'.$news->id)}}">
                    <div class="thumb d-block w-100" style="background-image: url('{{asset(str_replace("images","uploads/medium/",$news->image))}}');" title="{{$news->title}}">
                    </div>
                    <span class="create_date"><i class="far fa-clock"></i> {{$news->created_at->format('Y-m-d')}}</span>
                    <h2>{{mb_substr($news->title, 0, 56)}}...</h2>
                </a>
            </div>
        @endforeach
    </div>
    @endif
    {{$newslist->links()}}