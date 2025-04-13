<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'KateringME' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .full {
            height: 100vh;
            overflow: hidden;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
</head>

<body class="bg-light">

    {{ $slot }}

    <div class="modal fade" id="alert" tabindex="-1">
        <div class="modal-dialog">
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('alert') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="modal fade show" id="error" tabindex="-1">
        <div class="modal-dialog">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        @if (Session::get('alert'))
            var notif = new bootstrap.Modal(document.getElementById('alert'), {
                keyboard: false
            });
    
            notif.show();
        @endif
        @if ($errors->any())
            var notif = new bootstrap.Modal(document.getElementById('error'), {
                keyboard: false
            });

            notif.show();
        @endif
        
        if(document.getElementById('menu_form')){
            var modal = new bootstrap.Modal(document.getElementById('menu_form'), {
                keyboard: false
            });
            document.getElementById('tambah').onclick = function(e){
                modal.show()
            }
        }
        
        var id_gambar = 0
        const options = {
            Toolbar: {
                items: {
                    hapus: {
                        tpl: `<button class="f-button">Hapus</button>`,
                        click: () => hapus_redirect(),
                    },
                },
                display: {
                    left: ["infobar"],
                    middle: [],
                    right: ["hapus", "zoomIn", "zoomOut", "close"],
                },
            },
            groupAttr: false,
        };

        Fancybox.bind("[data-fancybox]", options);

        function hapus_redirect(){
            if(confirm('Yakin ingin menghapus foto ini?')){
                window.location.href = `{{ route('hapus_foto') }}/${id_gambar}`
            }
        }

        $('.hapus-btn').click(function(event){
            id_gambar = $(this).data('id')                
        })
    </script>
</body>

</html>
