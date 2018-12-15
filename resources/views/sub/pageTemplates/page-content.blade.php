<div class="post-detials">
    <div class="post_header">{{$page->title}}</div>
    <result>
        <div style="float: right;">
            <div style="display: inline-flex;">
                <script src="https://apis.google.com/js/platform.js" async defer></script>
                <div class="g-plus" data-action="share" data-annotation="bubble" data-href="{{asset('news/'.$page->id)}}"></div>
            </div>
            <div style="display: inline-flex;">
                <a name="twitter_share" data-count="horizontal" href="http://twitter.com/share?url=&amp{{asset('news/'.$page->id)}};" class="twitter-share-button" >Tweet</a>
            </div>
            <div style="display: inline-flex;">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-like" data-href="{{asset('news/'.$page->id)}}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
    </result>
    <div class="post_content">
        <img class="single_new_img" src="{{asset('uploads/'.$page->image)}}">
        {!!$page->text!!}
    </div>
    <result style="margin-top:15px; text-align: right;">
        <div style="display: inline-block;">
            <div style="display: inline-flex;">
                <script src="https://apis.google.com/js/platform.js" async defer></script>
                <div class="g-plus" data-action="share" data-annotation="bubble" data-href="{{asset('news/'.$page->id)}}"></div>
            </div>
            <div style="display: inline-flex;">
                <a name="twitter_share" data-count="horizontal" href="http://twitter.com/share?url=&amp{{asset('news/'.$page->id)}};" class="twitter-share-button" >Tweet</a>
            </div>
            <div style="display: inline-flex;">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-like" data-href="{{asset('news/'.$page->id)}}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
    </result>
</div>