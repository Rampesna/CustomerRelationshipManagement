<script>
    var fileUploadArea = $("#fileUploadArea");
    var fileUploader = $("#fileUploader");
    var uploadedFile = $("#uploadedFile");
    var filesCard = $("#filesCard");

    function getFiles() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.file.index') }}',
            data: {
                relation_type: 'App\\Models\\Customer',
                relation_id: '{{ $customer->id }}'
            },
            success: function (files) {
                $.each(files, function (index) {
                    if (files[index].mime_type === 'image/png' || files[index].mime_type === 'image/png' || files[index].mime_type === 'image/jpeg') {
                        filesCard.append(`
                    <div class="col-xl-2 mb-5 fileSelector" id="file_${files[index].id}" data-id="${files[index].id}">
                        <div class="card h-100">
                            <div class="card-body justify-content-center text-center flex-column p-8">
                                <a class="text-gray-800 text-hover-primary flex-column">
                                    <img style="width: 80%; height: auto" src="{{ asset('') }}${files[index].path + files[index].name}" alt="${files[index].name}">
                                    <div class="font-weight-bolder text-dark-75 mt-5">${files[index].name}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    `);
                    } else if (files[index].mime_type === 'application/pdf') {
                        filesCard.append(`
                    <div class="col-xl-2 mb-5 fileSelector" id="file_${files[index].id}" data-id="${files[index].id}">
                        <div class="card h-100">
                            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                <a class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <div class="symbol-60px mb-6 text-center">
                                        <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/files/pdf.svg" alt="${files[index].name}" />
                                    </div>
                                    <div class="font-weight-bolder text-dark-75">${files[index].name}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    `);
                    } else {
                        filesCard.append(`
                    <div class="col-xl-2 mb-5 fileSelector" id="file_${files[index].id}" data-id="${files[index].id}">
                        <div class="card h-100">
                            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                <a class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <div class="symbol-60px mb-6 text-center">
                                        <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/files/doc.svg" alt="${files[index].name}" />
                                    </div>
                                    <div class="font-weight-bolder text-dark-75">${files[index].name}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    `);
                    }
                });
            },
            error: function (error) {
                toastr.error('Dosyalar Alınırken Bir Hata Oluştu!');
                console.log(error)
            }
        });
    }

    function downloadFile(e) {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.file.show') }}',
            data: {
                id: $("#id_edit").val()
            },
            success: function (file) {
                window.open(`{{ asset('') }}${file.path + file.name}`, '_blank');
            },
            error: function () {

            }
        });
    }

    function drop() {
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.file.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: $("#id_edit").val()
            },
            success: function () {
                $("#file_" + $("#id_edit").val()).remove();
                toastr.success('Dosya Silindi');
            },
            error: function (error) {
                console.log(error)
                toastr.warning('Dosya Silinirken Bir Hata Oluştu');
            }
        });
    }

    getFiles();

    fileUploader.on('click', function () {
        uploadedFile.trigger('click');
    });

    fileUploadArea.on('dragenter', function (e) {
        e.preventDefault();
        e.stopPropagation();
    }).on('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
    }).on('drop', function (e) {
        if (e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
            e.preventDefault();
            e.stopPropagation();
            var data = new FormData();
            data.append('_token', '{{ csrf_token() }}');
            data.append('relation_type', 'App\\Models\\Customer');
            data.append('relation_id', '{{ $customer->id }}');
            data.append('file', e.originalEvent.dataTransfer.files[0]);
            upload(data);
        }
    });

    uploadedFile.change(function () {
        var data = new FormData();
        data.append('_token', '{{ csrf_token() }}');
        data.append('relation_type', 'App\\Models\\Customer');
        data.append('relation_id', '{{ $customer->id }}');
        data.append('file', $('#uploadedFile')[0].files[0]);
        upload(data);
    });

    function upload(data) {
        $.ajax({
            processData: false,
            contentType: false,
            type: 'post',
            url: '{{ route('ajax.file.save') }}',
            data: data,
            success: function (file) {
                if (file == null) {
                    toastr.error('Dosya Yüklenirken Bir Hatayla Karşılaşıldı');
                } else if (file.mime_type === 'image/png' || file.mime_type === 'image/png' || file.mime_type === 'image/jpeg') {
                    filesCard.append(`
                    <div class="col-xl-2 mb-5 fileSelector" id="file_${file.id}" data-id="${file.id}">
                        <div class="card h-100">
                            <div class="card-body justify-content-center text-center flex-column p-8">
                                <a class="text-gray-800 text-hover-primary flex-column">
                                    <img style="width: 80%; height: auto" src="{{ asset('') }}${file.path + file.name}" alt="${file.name}">
                                    <div class="font-weight-bolder text-dark-75 mt-5">${file.name}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    `);
                } else if (file.mime_type === 'application/pdf') {
                    filesCard.append(`
                    <div class="col-xl-2 mb-5 fileSelector" id="file_${file.id}" data-id="${file.id}">
                        <div class="card h-100">
                            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                <a class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <div class="symbol-60px mb-6 text-center">
                                        <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/files/pdf.svg" alt="${file.name}" />
                                    </div>
                                    <div class="font-weight-bolder text-dark-75">${file.name}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    `);
                } else {
                    filesCard.append(`
                    <div class="col-xl-2 mb-5 fileSelector" id="file_${file.id}" data-id="${file.id}">
                        <div class="card h-100">
                            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                <a class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <div class="symbol-60px mb-6 text-center">
                                        <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/files/doc.svg" alt="${file.name}" />
                                    </div>
                                    <div class="font-weight-bolder text-dark-75">${file.name}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    `);
                }
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    $(document).delegate('.fileSelector', 'click', function (e) {
        $("#id_edit").val($(this).data('id'));

        var top = e.pageY - 10;
        var left = e.pageX - 10;

        $("#context-menu").css({
            display: "block",
            top: top,
            left: left
        });

        return false;
    });

    $(document).click((e) => {
        $("#context-menu").hide();
    });
</script>
