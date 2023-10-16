<h2>Merhaba {{siteInfo()->site_name}} sitesi yöneticisi,</h2> <br><br>
 Bir hata bildirimi aldınız. <br><br>
Detaylar: <br><br>
Film: {{ $movie }} <br>
Url: <a href="{{Request::root().'/filmler/'.$url }}">{{Request::root().'/filmler/'.$url }}</a> <br>
Mesaj: {{ $user_query }}
