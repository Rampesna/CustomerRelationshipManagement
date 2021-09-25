<script>

    var FilterButton = $('#FilterButton');
    var usersRow = $('#usersRow');
    var usersSelection = $('#usersSelection');

    function getUsersForSelection() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.user.all') }}',
            data: {},
            success: function (users) {
                usersSelection.empty();
                $.each(users, function (i, user) {
                    usersSelection.append(`<option value="${user.id}">${user.name}</option>`);
                });
                usersSelection.selectpicker('refresh');
            },
            error: function () {

            }
        });
    }

    function getUsers() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var users = usersSelection.val();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.user.all.with.target') }}',
            data: {
                start_date: start_date,
                end_date: end_date,
                users: users
            },
            success: function (users) {
                console.log(users)
                usersRow.html('');
                $.each(users, function (i, user) {
                    usersRow.append(`
                        <div class="col-xl-3">
                            <div class="card card-custom card-stretch">
                                <div class="card-body pb-3 pt-3">
                                    <div class="row">
                                        <div class="col-xl-12 text-center mb-2">
                                            <h5>${user.name}</h5>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <a class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer">
                                            <i class="fas fa-chart-pie fa-2x text-primary"></i><br><br>
                                            <span class="mb-0 font-weight-bold cursor-pointer">Fırsat</span>
                                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 18px">${user.opportunity_target}</h4>
                                        </a>
                                        <a class="col pb-4 pt-4 text-dark-75 cursor-pointer">
                                            <i class="fas fa-chart-bar fa-2x text-info"></i><br><br>
                                            <span class="mb-0 font-weight-bold cursor-pointer">Aktivite</span>
                                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 18px">${user.activity_target}</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    getUsers();
    getUsersForSelection();

    FilterButton.click(function () {
        getUsers();
    });

</script>
