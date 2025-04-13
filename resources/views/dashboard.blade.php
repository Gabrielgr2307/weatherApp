<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            👋 Hola, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-8">
                <div class="text-center mb-6">
                    <h3 class="text-lg text-gray-700 font-semibold">Consulta el clima por ciudad</h3>
                    <p class="text-sm text-gray-500">Selecciona un país y una ciudad para obtener la información actual
                        del clima.</p>
                </div>

                <form id="registerTerm">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="country-select"
                                class="block text-sm font-medium text-gray-700 mb-1">País</label>
                            <select id="country-select" name="country"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Seleccione un país...</option>
                            </select>
                        </div>
                        <div>
                            <label for="city-select" class="block text-sm font-medium text-gray-700 mb-1">Ciudad</label>
                            <select id="city-select" name="city"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                disabled>
                                <option value="">Seleccione una ciudad...</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <button type="button" id="search-weather"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700 transition">
                            Buscar Clima
                        </button>
                    </div>

                </form>

                <!-- Tarjeta de clima con diseño y botón de favoritos -->
                <div id="weather-card"
                    class="mt-10 hidden bg-gradient-to-tr from-blue-100 to-white border border-blue-200 rounded-xl p-6 shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h4 class="text-2xl font-bold text-gray-800" id="weather-ciudad"></h4>
                            <p class="text-sm text-gray-600" id="weather-hora_local"></p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <img id="weather-icono" src="" alt="Weather icon" class="w-16 h-16">
                            <button id="favorite-button"
                                class="text-2xl text-gray-400 hover:text-yellow-400 transition transform"
                                title="Marcar como favorito">☆</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-700">
                        <div class="bg-white rounded-lg shadow p-4">
                            <p class="font-medium">Temperatura</p>
                            <p class="text-blue-600 font-semibold" id="weather-temperatura"></p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-4">
                            <p class="font-medium">Humedad</p>
                            <p class="text-blue-600 font-semibold" id="weather-humedad"></p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-4">
                            <p class="font-medium">Viento</p>
                            <p class="text-blue-600 font-semibold" id="weather-viento_kph"></p>
                        </div>
                    </div>

                    <div class="mt-4 text-right">
                        <p class="text-sm text-gray-500 italic" id="weather-pais"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="click-sound" src="/sounds/click.mp3" preload="auto"></audio>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Incluir Select2 CSS y JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#country-select').select2({
                placeholder: "Seleccione un país",
                allowClear: true
            });
            $('#city-select').select2({
                placeholder: "Seleccione una ciudad",
                allowClear: true
            });
            // Cargar países
            $.get('/country/selectCountry', function(data) {
                $('#country-select').empty();
                $('#country-select').append("<option value=''>Seleccione un país...</option>");
                $.each(data, function(index, countryObj) {
                    $('#country-select').append("<option value='" + countryObj.id + "'>" +
                        countryObj.name + "</option>");
                });
            });
        });
        // Manejar el cambio en el selector de países
        $('#country-select').on('change', function() {
            const countryId = $(this).val();
            $('#city-select').prop('disabled', !countryId);
            if (countryId) {
                $.get('/country/selectCitys/' + countryId, function(cities) {
                    $('#city-select').empty();
                    $('#city-select').append("<option value=''>Seleccione una ciudad...</option>");
                    $.each(cities, function(index, cityObj) {
                        $('#city-select').append("<option value='" + cityObj.name + "'>" + cityObj
                            .name + "</option>");
                    });
                });
            } else {
                $('#city-select').empty().append(
                "<option value=''>Seleccione una ciudad...</option>"); // Reiniciar ciudades
            }
        });
        // Envío de Formulario
        $("#search-weather").click(function() {
            var form = $("#registerTerm");
            form.validate({
                rules: {
                    country: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                },
                messages: {
                    country: {
                        required: "Por favor, seleccione un país.",
                    },
                    city: {
                        required: "Por favor, seleccione una ciudad.",
                    },
                }
            });
            if (form.valid()) {
                var formData = new FormData(form[0]);
                var route = "weatherBlade/weatherclimate";
                var method = "POST";
                $.ajax({
                    url: route,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        swal({
                            icon: "info",
                            title: 'Consultando clima, espere!',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            onOpen: () => {
                                swal.showLoading();
                            }
                        });
                    },
                    success: function(res) {
                        swal('', res.resul.msg, 'success');

                        // Mostrar tarjeta de clima
                        $('#weather-pais').text(res.resul.pais);
                        $('#weather-ciudad').text(res.resul.ciudad);
                        $('#weather-hora_local').text(res.resul.hora_local);
                        $('#weather-humedad').text(res.resul.humedad);
                        $('#weather-temperatura').text(res.resul.temperatura);
                        $('#weather-viento_kph').text(res.resul.viento_kph);
                        $('#weather-icono').attr('src', res.resul.icono);
                        $('#weather-card').removeClass('hidden'); // Mostrar la tarjeta
                    },
                    error: function(res) {
                        setTimeout(function() {
                            swal('Error al consultar', 'Verifique los datos ingresados.',
                                'error');
                        }, 3000);
                    }
                });
            } else {
                swal('Oops...', 'Hay un error en el formulario, por favor corríjelo!', 'error');
            }
        });
        // Reiniciar la búsqueda
        $('#country-select, #city-select').on('change', function() {
            $('#weather-card').addClass('hidden'); // Ocultar la tarjeta al cambiar la búsqueda
        });


        document.addEventListener('DOMContentLoaded', function() {
            const clickSound = document.getElementById('click-sound');
            document.getElementById('favorite-button').addEventListener('click', function() {
                const city = document.getElementById('weather-ciudad').innerText;
                const button = this;
                // Usar AJAX en lugar de fetch
                $.ajax({
                    url: "favoritesBlade/toggle",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        city
                    }),
                    headers: {
                        "X-CSRF-TOKEN": '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        clickSound.play();
                        if (data.message === 'Agregado') {
                            button.innerText = '★';
                            button.classList.add('text-yellow-400');
                            button.classList.remove('text-gray-400');
                            swal("Favorito agregado", city + " ha sido marcado como favorito",
                                "success");
                        } else {
                            button.innerText = '☆';
                            button.classList.add('text-gray-400');
                            button.classList.remove('text-yellow-400');
                            swal("Favorito removido", city + " ha sido quitado de favoritos",
                                "info");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                        swal("Error", "Hubo un problema al procesar la solicitud.", "error");
                    }
                });
            });
        });
    </script>
</x-app-layout>
