<div class="container container1" style="padding-top: 15%">
    <div class="colorlib-featured ">
        <div class="row animate-box">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h2 style="color: whitesmoke" class="mb-0">Favourite Co-Worker</h2>
                </div>
                <div class="">
                    <table id="customers">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($favourites as $u)
                            <tr>
                                <td>
                                    {{$u->name}}
                                </td>
                                <td>
                                    {{$u->email}}
                                </td>
                                <td>
                                    <input data-wk="yes" type="reset" class="listfv btn btn-sm btn-primary"
                                           data-id="{{$u->id}}" value="Remove favourite">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div data-pjax class="col-md-12 text-center">
                        <ul class="pagination">
                            {{$favourites->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.listfv').each(function () {
        $(this).click(function () {
            var user_co_id = $(this).attr('data-id');
            var check = true;
            if ($(this).attr('data-wk') === 'no') check = false;
            if (check) {
                $(this).attr('data-wk', 'no');
                $(this).attr('value', 'Add favorite');
            } else {
                $(this).attr('data-wk', 'yes');
                $(this).attr('value', 'Remove favorite');
            }
            $.ajax({
                url: '{{ route('toggleCoWorker') }}',
                dataType: 'json',
                data: {'user_co_id': user_co_id},
                success: function (data) {

                }
            });
        });
    });
</script>
<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 1,
        loop: true,
        autoplay: false,
        autoplayTimeout: 1000,
        autoplayHoverPause: true
    });
    owl.trigger('stop.owl.autoplay');
</script>