<form action="{{route('front.search')}}" class="header__search" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__search-content">
                    <input name="search" type="search" placeholder="Film ara">
                    <button type="submit">ara</button>
                </div>
            </div>
        </div>
    </div>
</form>
