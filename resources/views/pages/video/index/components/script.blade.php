<script>

    var videosRow = $('#videosRow');

    function getVideos() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.video.index') }}',
            data: {},
            success: function (videos) {
                $.each(videos, function (i, video) {
                    videosRow.append(`
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header pt-5 pb-3 text-center">
                                <h6>${video.name}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="${video.url}" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                toastr.error('Videolar Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                console.log(error);
            }
        });
    }

    getVideos();

    $('body').on('contextmenu', function (e) {
        var top = e.pageY - 10;
        var left = e.pageX - 10;
        $("#context-menu").css({
            display: "block",
            top: top,
            left: left
        });
        return false;
    }).on("click", function () {
        $("#context-menu").hide();
    }).on('focusout', function () {
        $("#context-menu").hide();
    });

</script>
