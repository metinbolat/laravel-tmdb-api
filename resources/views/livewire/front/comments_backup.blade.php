

            <!-- comments -->
            <div class="col-12">
                <div class="comments">
                    @if(session('comment_success'))
                        <div style="color: lightgreen;">
                            {{ session('comment_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('comment_error'))
                        <div style="color: red;">
                            {{ session('comment_error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <ul class="comments__list">
                        @forelse($comments as $comment)

                            <li class="comments__item">
                                <div class="comments__autor">
                                    <img class="comments__avatar" src="img/user.png" alt="">
                                    <span class="comments__name">{{$comment->user_name}}</span>
                                    <span class="comments__time">{{$comment->created_at->format('d.m.y H:i')}}</span>
                                </div>
                                <p class="comments__text">{{$comment->comment}}</p>
                                {{--                                                                     <div class="comments__actions">--}}
                                {{--                                                                         <div class="comments__rate">--}}
                                {{--                                                                             <button type="button"><i--}}
                                {{--                                                                                     class="icon ion-md-thumbs-up"></i>12</button>--}}

                                {{--                                                                             <button type="button">7<i--}}
                                {{--                                                                                     class="icon ion-md-thumbs-down"></i></button>--}}
                                {{--                                                                         </div>--}}

                                {{--                                                                         <button onclick="reply(this)" type="button"><i--}}
                                {{--                                                                                 class="icon ion-ios-share-alt"></i>Yanıt Ver</button>--}}
                                {{--                                                                         <button type="button"><i--}}
                                {{--                                                                                 class="icon ion-ios-quote"></i>Quote</button>--}}
                                {{--                                                                     </div>--}}
                            </li>
                            <li id="reply" class="comments__item comments__item--answer">
                                <form class="form">
                                    @csrf
                                    @guest()
                                        <ul class="comments__list">
                                            <li class="comments__item">
                                                <p class="comments__text">Yanıt vermek için <a
                                                        href="{{route('register')}}">üye olma</a>nız gerekli.</p>
                                            </li>
                                        </ul>
                                    @else
                                        <input name="reply" type="text" class="form__input" placeholder="{{$comment->user_name}} kullanıcısına yanıt ver">
                                        <button type="submit" class="form__btn">Yanıt Ver</button>
                                    @endguest
                                </form>
                            </li>
                            @foreach($comment->replies->where('is_public', 1) as $reply)
                                <li class="comments__item comments__item--answer">
                                    <div class="comments__autor">
                                        <img class="comments__avatar" src="img/user.png" alt="">
                                        <span class="comments__name">{{$reply->user_name}} <small>({{$comment->user_name}} için yanıt)</small></span>
                                        <span class="comments__time">{{$reply->created_at->format('d.m.y H:i')}}</span>
                                    </div>
                                    <p class="comments__text">{{$reply->comment}}</p>
                                    {{--                                                                 <div class="comments__actions">--}}
                                    {{--                                                                     <div class="comments__rate">--}}
                                    {{--                                                                         <button type="button"><i--}}
                                    {{--                                                                                 class="icon ion-md-thumbs-up"></i>8</button>--}}

                                    {{--                                                                         <button type="button">3<i--}}
                                    {{--                                                                                 class="icon ion-md-thumbs-down"></i></button>--}}
                                    {{--                                                                     </div>--}}

                                    {{--                                                                     <button type="button"><i--}}
                                    {{--                                                                             class="icon ion-ios-share-alt"></i>Reply</button>--}}
                                    {{--                                                                     <button type="button"><i--}}
                                    {{--                                                                             class="icon ion-ios-quote"></i>Quote</button>--}}
                                    {{--                                                                 </div>--}}
                                </li>
                            @endforeach
                        @empty
                        @endforelse
                    </ul>

                    <form class="form" wire:submit.prevent="commentStore">

                        @guest
                            <ul class="comments__list">
                                <li class="comments__item">
                                    <p class="comments__text">Yorum yapmak için <a
                                            href="{{route('register')}}">üye olma</a>nız gerekli.</p>
                                </li>
                            </ul>
                            @error('name')<small style="color: red;"> {{$message}}</small> @enderror
                        @else
                            <textarea id="text" wire:model.defer="comment_body" class="form__textarea" placeholder="Yorum"></textarea>
                            @error('comment_body')<small style="color: red;"> {{$message}}</small> @enderror

                            <button type="submit" class="form__btn">Yorum Yap</button>
                        @endguest


                    </form>
                </div>
            </div>

            <!-- end comments -->



