@extends('templates/template')
@section('content')
<style>
    .auto-size-btn {
        height: 40px;
        line-height: 40px;
        padding: 0 15px;
        font-size: 14px;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      -webkit-font-smoothing: antialiased;
    }
    p {
      line-height: 1.6;
      padding: 0 20px;
    }
    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
      font-weight: 700;
      line-height: 1.2;
      letter-spacing: 0.8px;
    }
    .card {
      box-shadow: none;
    }
    .gender-number {
        font-size: 25px;
        font-weight: 700;
        color: #495057;
        margin-bottom: 0px;
    }
    .gender-label {
        font-weight: 700;
        font-size: 22px; /* Memperbesar ukuran font label */
        color: #495057;
        margin-bottom: 0px; /* Menambahkan margin bawah untuk jarak dengan penjelasan */
    }
    .gender-description {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 10px;
        padding: 0px;
    }
    .gender-total {
        color:#ae9f9f;
    }
    .fw-700 {
        font-weight: 700;
    }
    .custom-header {
        text-align: center;
        position: relative;
    }
    .custom-header::before, .custom-header::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 40%;
        height: 2px;
        background-color: #000;
    }
    .custom-header::before {
        left: 0;
    }
    .custom-header::after {
        right: 0;
    }
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-4 text-center">
                    <label for="">Pilih Program</label>
                    <select class="form-control" name="program_id" id="program_id">
                        @foreach ($programs as $key => $program)
                            <option {{ $key == 0 ? 'selected' : '' }} value="{{ $program->mcu_program_id }}">
                                {{ $program->mcu_program_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="main"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <!-- AREA CHART -->
                    <div class="card">
                      <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title fw-700">Demografi Peserta</h3>
                          <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                      </div>
                      <div class="card-body">
                        <div id="chart_peserta" style="width: 100%; height: 200px;"></div>
                      </div>
                    </div>
                    <!-- /.card -->
                    <!-- AREA CHART -->
                    <div class="card">
                      <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title fw-700">Demografi Usia</h3>
                          <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                      </div>
                      <div class="card-body">
                        <div id="chart_usia" style="width: 100%; height: 200px;"></div>
                      </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-left pt-3">
                                    <div class="gender-label">Pria</div>
                                    <div id="chart_male" style="width:100%; height: 121px;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-left pt-3">
                                    <div class="gender-label">Wanita</div>
                                    <div id="chart_female" style="width:100%; height: 121px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title fw-700">Riwayat Penyakit Terbanyak</h3>
                              <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="chart_riwayat_penyakit" style="width: 100%; height: 300px;"></div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title fw-700">10 Diagnosa Lab Terbanyak</h3>
                              <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="chart_riwayat_diagnosa_lab" style="width: 100%; height: 260px;"></div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title fw-700">10 Diagnosa Non Lab Terbanyak</h3>
                              <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="chart_riwayat_diagnosa_non_lab" style="width: 100%; height: 260px;"></div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <header class="custom-header mt-2">
                <h3>Kesimpulan</h3>
            </header>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                      <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title fw-700">Kategori Kesehatan Peserta</h3>
                          <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                      </div>
                      <div class="card-body">
                        <div id="chart_kategori_kesehatan" style="width: 100%; height: 250px;"></div>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                      <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title fw-700">Peserta Sindrom Metabolik</h3>
                          <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                      </div>
                      <div class="card-body">
                        <div id="chart_kategori_sindrom_metabolik" style="width: 100%; height: 250px;"></div>
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title fw-700">Indikator Gejala Sindrom Metabolik</h3>
                              <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="chart_gejala" style="width: 100%; height: 250px;"></div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title fw-700">Kesimpulan</h3>
                            </div>
                          </div>
                          <div class="card-body" id="conclusion" style="min-height: 250px; overflow-y: scroll;">Belum terdapat kesimpulan!
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title fw-700">Saran</h3>
                            </div>
                          </div>
                          <div class="card-body" id="recommendation" style="min-height: 250px; overflow-y: scroll;">Belum terdapat saran!
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.3/dist/echarts.min.js"></script>

    <script>
        $(document).ready(function() {
            var dataParticipant = [];
            var dataAge = [];
            var dataDiseaseHistory = [];
            var dataDiagnosis = [];
            var dataNonLabDiagnosis = [];
            var dataHealthCategory = [];
            var dataMetabolicSyndrome = {};
            var dataSymptoms = [];
        })

        //temporary
        getAllDataChart()

        $(document).on("change", "#program_id", function() {
            getAllDataChart()
        });

        function buildChartMale(chartDom, male, total) {
            var data = [
                { value: total, name: 'Total', itemStyle: { color: '#DADFE9' } },
                { value: male, name: 'Pria', itemStyle: { color: '#0F3B99' } }
            ];

            // Inisialisasi chart
            var chartDom = document.getElementById(chartDom);
            var myChart = echarts.init(chartDom);

            // Cari total untuk "Pria" secara dinamis
            var priaTotal = data.find(item => item.name === 'Pria').value;
            var totalValue = data.find(item => item.name === 'Total').value;

            var option = {
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    show: true,  // Tampilkan legend
                    bottom: '0%',  // Tempatkan legend di bawah chart
                    left: 'center',  // Letakkan legend di tengah secara horizontal
                    itemWidth: 20,  // Lebar item di legend
                    itemHeight: 14,  // Tinggi item di legend
                    textStyle: {
                        fontSize: 14,  // Ukuran font untuk teks legend
                        color: '#333'  // Warna teks legend
                    },
                    formatter: function(name) {
                        // Format teks legend dengan menambahkan value di dalam kurung
                        if (name === 'Total') {
                            return name + ' (' + totalValue + ')';
                        } else if (name === 'Pria') {
                            return name + ' (' + priaTotal + ')';
                        }
                        return name;
                    }
                },
                series: [
                    {
                        name: 'Peserta',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        center: ['50%', '35%'],  // Menyesuaikan posisi chart ke tengah atas
                        avoidLabelOverlap: false,
                        label: {
                            show: false,  // Sembunyikan label pada segmen
                        },
                        labelLine: {
                            show: false  // Sembunyikan garis label
                        },
                        data: data
                    }
                ],
                graphic: [
                    {
                        type: 'text',
                        left: 'center',
                        top: '27%',  // Geser teks lebih tinggi dari posisi tengah
                        style: {
                            text: priaTotal.toString(),  // Tampilkan nilai total untuk "Pria"
                            textAlign: 'center',
                            font: 'bold 20px sans-serif',
                            fill: '#0F3B99' // Set warna teks sesuai dengan warna "Pria"
                        }
                    }
                ]
            };

            // Setel opsi chart
            myChart.setOption(option);
        }

        function buildChartFemale(chartDom, male, total) {
            var data = [
                { value: total, name: 'Total', itemStyle: { color: '#DADFE9' } },
                { value: male, name: 'Wanita', itemStyle: { color: '#A1D6FC' } }
            ];

            // Inisialisasi chart
            var chartDom = document.getElementById(chartDom);
            var myChart = echarts.init(chartDom);

            // Cari total untuk "Wanita" secara dinamis
            var wanitaTotal = data.find(item => item.name === 'Wanita').value;
            var totalValue = data.find(item => item.name === 'Total').value;

            var option = {
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    show: true,  // Tampilkan legend
                    bottom: '0%',  // Tempatkan legend di bawah chart
                    left: 'center',  // Letakkan legend di tengah secara horizontal
                    itemWidth: 20,  // Lebar item di legend
                    itemHeight: 14,  // Tinggi item di legend
                    textStyle: {
                        fontSize: 14,  // Ukuran font untuk teks legend
                        color: '#333'  // Warna teks legend
                    },
                    formatter: function(name) {
                        // Format teks legend dengan menambahkan value di dalam kurung
                        if (name === 'Total') {
                            return name + ' (' + totalValue + ')';
                        } else if (name === 'Wanita') {
                            return name + ' (' + wanitaTotal + ')';
                        }
                        return name;
                    }
                },
                series: [
                    {
                        name: 'Peserta',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        center: ['50%', '35%'],  // Menyesuaikan posisi chart ke tengah atas
                        avoidLabelOverlap: false,
                        label: {
                            show: false,  // Sembunyikan label pada segmen
                        },
                        labelLine: {
                            show: false  // Sembunyikan garis label
                        },
                        data: data
                    }
                ],
                graphic: [
                    {
                        type: 'text',
                        left: 'center',
                        top: '27%',  // Geser teks lebih tinggi dari posisi tengah
                        style: {
                            text: wanitaTotal.toString(),  // Tampilkan nilai total untuk "Pria"
                            textAlign: 'center',
                            font: 'bold 20px sans-serif',
                            fill: '#0F3B99' // Set warna teks sesuai dengan warna "Pria"
                        }
                    }
                ]
            };

            // Setel opsi chart
            myChart.setOption(option);
        }

        function buildChartParticipant(chartDom, data) {
            chartDom = document.getElementById(chartDom)
            var myChart = echarts.init(chartDom);
            var option = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                grid: {
                    left: '1%',
                    right: '1%',
                    top  : '1%',
                    bottom: '25px',  // Memberikan ruang lebih di bawah untuk dataZoom
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'category',
                        data: data.map(item => item.name),  // Ambil nama dari data
                        axisLabel: {
                            rotate: 45,  // Miringkan label
                            interval: 0,  // Agar semua label ditampilkan
                            formatter: function (value) {
                                // Potong teks jika terlalu panjang dan tambahkan elipsis
                                return value.length > 10 ? value.slice(0, 5) + '...' : value;
                            }
                        }
                    }
                ],
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                series: [
                    {
                        name: 'Pria',
                        type: 'bar',
                        stack: 'Gender',
                        emphasis: {
                            itemStyle: {
                                color: '#0F3B99'  // Warna saat hover untuk Pria
                            }
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: function(params) {
                                return params.value;  // Menampilkan nilai total dalam batang
                            },
                            color: '#fff'  // Pastikan warna label tetap putih
                        },
                        itemStyle: {
                            color: '#0F3B99'  // Warna untuk batang Pria
                        },
                        data: data.map(item => item.male)  // Ambil data male dari data
                    },
                    {
                        name: 'Wanita',
                        type: 'bar',
                        stack: 'Gender',
                        emphasis: {
                            itemStyle: {
                                color: '#A1D6FC'  // Warna saat hover untuk Wanita
                            }
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: function(params) {
                                return params.value;  // Menampilkan nilai total dalam batang
                            },
                            color: '#fff'  // Pastikan warna label tetap putih
                        },
                        itemStyle: {
                            color: '#A1D6FC'  // Warna untuk batang Wanita
                        },
                        data: data.map(item => item.female)  // Ambil data female dari data
                    }
                ],
                dataZoom: [
                    {
                      type: 'slider',
                      show: true,
                      xAxisIndex: [0],  // Menggunakan data pada sumbu X
                      start: 0,  // Posisi awal zoom
                      end: 55,  // Posisi akhir zoom
                      bottom: '10',  // Menempatkan dataZoom tepat di bawah grafik
                      height: 20  // Menambah tinggi slider dataZoom agar lebih mudah dilihat
                    }
                ]
            };

            // Set opsi dan tampilkan grafik
            myChart.setOption(option);
        }

        function buildChartAge(chartDom, dataUsia) {
            var chartDom = document.getElementById(chartDom);
            // Menyiapkan data untuk chart
            var usiaKategori = dataUsia.map(item => item.name); // Kategori usia
            var maleData = dataUsia.map(item => item.male); // Data male
            var femaleData = dataUsia.map(item => item.female); // Data female

            var myChart = echarts.init(chartDom);

            var option = {
                color: ['#0F3B99', '#A1D6FC'], // Warna solid untuk male dan female
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                legend: {
                    data: ['Pria', 'Wanita'],
                    bottom: '0%',  // Menempatkan legend lebih rendah di bawah sumbu X
                    orient: 'horizontal',  // Legend horizontal
                    itemWidth: 15,  // Lebar item legend
                    itemHeight: 15,  // Tinggi item legend
                    itemStyle: {
                        borderRadius: '50%',  // Membuat item legend bulat
                        borderWidth: 0  // Menghilangkan border item legend
                    },
                    textStyle: {
                        fontSize: 14, // Ukuran font legend
                        fontWeight: 'bold' // Tebalkan font legend
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    top: '3%',
                    bottom: '17%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'category',
                        boundaryGap: false,
                        data: usiaKategori
                    }
                ],
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                series: [
                    {
                        name: 'Pria',
                        type: 'line',
                        stack: 'total',
                        smooth: true,
                        lineStyle: {
                            width: 0
                        },
                        showSymbol: false,
                        areaStyle: {
                            opacity: 1,  // Mengurangi transparansi (jadi solid)
                            color: '#0F3B99'  // Warna solid untuk male
                        },
                        emphasis: {
                            focus: 'series'
                        },
                        data: maleData,
                        label: {
                            show: true,  // Menampilkan label
                            position: 'top',  // Posisi label di atas titik
                            formatter: '{c}'  // Format label untuk menampilkan nilai
                        }
                    },
                    {
                        name: 'Wanita',
                        type: 'line',
                        stack: 'total',
                        smooth: true,
                        lineStyle: {
                            width: 0
                        },
                        showSymbol: false,
                        areaStyle: {
                            opacity: 1,  // Mengurangi transparansi (jadi solid)
                            color: '#A1D6FC'  // Warna solid untuk female
                        },
                        emphasis: {
                            focus: 'series'
                        },
                        data: femaleData,
                        label: {
                            show: true,  // Menampilkan label
                            position: 'top',  // Posisi label di atas titik
                            formatter: '{c}'  // Format label untuk menampilkan nilai
                        }
                    }
                ]
            };

            myChart.setOption(option);
        }

        function buildChartDiseaseHistory(chartDom, data) {
            chartDom = document.getElementById(chartDom);
            var myChart = echarts.init(chartDom);
            
            var option = {
                tooltip: {
                    trigger: 'item',
                    formatter: '{b}<br/>Jumlah Diagnosa: {c} ({d}%)'
                },
                legend: {
                    orient: 'horizontal',  // Display the legend horizontally
                    bottom: '0%',          // Position the legend at the bottom of the chart
                    left: 'center',        // Center the legend horizontally
                    data: data.map(item => item.name)  // Use disease names as legend items
                },
                series: [
                    {
                        name: 'Diseases',
                        type: 'pie',
                        radius: ['40%', '70%'],  // Donut effect
                        center: ['50%', '35%'],
                        data: data.map(item => ({
                            name: item.name,
                            value: item.diagnosis_count
                        })),
                        label: {
                            show: true,          // Show labels inside the chart
                            position: 'inside',  // Position the labels inside the donut
                            formatter: '{c}',
                            fontSize: 14,
                            fontWeight: 'bold',
                            color: '#fff'
                        },
                        labelLine: {
                            show: false // Hides the label lines (arrows)
                        },
                        itemStyle: {
                            color: function(params) {
                                // Use a color array to give each slice a different color
                                const colors = ['#0F3B99', '#5886E9', '#FFC505', '#FF9705', '#A1D6FC', '#37CDC1', '#DC3545', '#3D3D3D', '#51CD37', '#FF5005' ];
                                return colors[params.dataIndex % colors.length];
                            }
                        }
                    }
                ]
            };

            myChart.setOption(option);
        }

        function buildChartLabDiagnosis(chartDom, data) {
            chartDom = document.getElementById(chartDom);
            var myChart = echarts.init(chartDom);

            // Menambahkan sorting pada data sebelum dimasukkan ke dalam dataset
            data.sort((a, b) => (b.male + b.female) - (a.male + a.female));  // Mengurutkan berdasarkan total (pria + wanita)

            var option = {
                grid: {
                    left: '5%',  // Remove left margin
                    right: '5%', // Remove right margin
                    top: '5%',   // Remove top margin
                    bottom: '20%' // Remove bottom margin
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'  // Menampilkan pointer pada batang
                    },
                    formatter: function (params) {
                        var data = params[0].data;
                        return `
                            <strong>${data.name}</strong><br/>
                            Pria: ${data.male}<br/>
                            Wanita: ${data.female}<br/>
                            <strong>Total: ${data.total}</strong>
                        `;
                    }
                },
                dataset: [
                    {
                        dimensions: ['name', 'male', 'female', 'total'],
                        source: data.map(item => ({
                            name: item.name,
                            male: item.male,
                            female: item.female,
                            total: item.male + item.female  // Menambahkan kolom total yang merupakan jumlah male + female
                        }))
                    }
                ],
                xAxis: {
                    type: 'category',  // Menampilkan kategori pada sumbu X
                    axisLabel: {
                        interval: 0,  // Menampilkan semua label pada sumbu X
                        formatter: function (value) {
                            // Truncate label text if too long and add "..."
                            return value.length > 6 ? value.slice(0, 6) + '...' : value;
                        },
                        rotate: 45  // Memiringkan label agar lebih mudah dibaca
                    }
                },
                yAxis: {
                    type: 'value',  // Menampilkan jumlah diagnosa pada sumbu Y
                    axisLabel: {
                        formatter: function (value) {
                            return value;  // Menampilkan jumlah diagnosa pada sumbu Y
                        }
                    }
                },
                series: [
                    {
                        name: 'Total',  // Series untuk jumlah total (male + female)
                        type: 'bar',
                        encode: { x: 'name', y: 'total' },
                        itemStyle: {
                            color: '#0F3B99'  // Mengganti warna batang menjadi biru tua
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: function (params) {
                                return params.data.total;  // Menampilkan jumlah total diagnosa di dalam batang
                            },
                            fontSize: 14,
                            fontWeight: 'bold',
                            color: '#fff'
                        }
                    }
                ]
            };

            // Set options and render the chart
            myChart.setOption(option);
        }

        function buildChartNonLabDiagnosis(chartDom, data) {
            chartDom = document.getElementById(chartDom);
            var myChart = echarts.init(chartDom);

            // Menambahkan sorting pada data sebelum dimasukkan ke dalam dataset
            data.sort((a, b) => b.abnormal - a.abnormal);  // Mengurutkan berdasarkan abnormal secara menurun

            var option = {
                grid: {
                    left: '5%',  // Remove left margin
                    right: '5%', // Remove right margin
                    top: '5%',   // Remove top margin
                    bottom: '20%' // Remove bottom margin
                },
                tooltip: {
                    trigger: 'item',
                    formatter: function (params) {
                        var data = params.data;
                        return `
                            <strong>${data.name}</strong><br/>
                            Abnormal: ${data.abnormal}
                        `;
                    }
                },
                dataset: [
                    {
                        dimensions: ['name', 'abnormal'],
                        source: data.map(item => ({
                            name: item.name,
                            abnormal: item.abnormal
                        }))
                    }
                ],
                xAxis: {
                    type: 'category',
                    axisLabel: {
                        interval: 0,
                        rotate: 45,
                        formatter: function (value) {
                            return value.length > 10 ? value.slice(0, 10) + '...' : value;
                        }
                    }
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        formatter: function (value) {
                            return value;
                        }
                    }
                },
                series: [
                    {
                        name: 'Abnormal',
                        type: 'bar',
                        encode: { x: 'name', y: 'abnormal' },
                        itemStyle: {
                            color: '#A1D6FC'  // Solid blue color for the bars
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: function (params) {
                                return params.data.abnormal;
                            },
                            fontSize: 14,
                            fontWeight: 'bold', // Tebalkan font legend
                            color: '#fff'
                        }
                    }
                ]
            };

            myChart.setOption(option);
        }

        function buildChartHealthCategory(chartDom, data) {
            var chartDom = document.getElementById(chartDom);
            var myChart = echarts.init(chartDom);
            
            var option = {
                tooltip: {
                    trigger: 'item'  // Tipe tooltip yang muncul ketika item dipilih
                },
                legend: {
                    bottom: '0%',
                    left: 'center',
                    orient: 'horizontal',  // Orientasi horizontal
                    itemWidth: 10,  // Menentukan lebar ikon legend
                    itemHeight: 10,  // Menentukan tinggi ikon legend
                    textStyle: {
                        fontSize: 14  // Ukuran font untuk teks legenda
                    }
                },
                color: ['#0F3B99', '#5886E9', '#FF9800', '#F44336', '#37CDC1'],  // Menentukan warna untuk sektor chart
                series: [
                    {
                        name: 'Kesehatan Peserta',
                        type: 'pie',  // Tipe grafik pie
                        radius: ['40%', '82%'],  // Mengatur jari-jari bagian dalam dan luar pie chart
                        avoidLabelOverlap: false,
                        label: {
                            show: true,  // Menampilkan label di dalam pie
                            position: 'inside',  // Menempatkan label di dalam potongan
                            formatter: '{c}',  // Hanya menampilkan nilai (angka)
                            fontSize: 14,  // Ukuran font untuk label
                            fontWeight: 'bold', // Menebalkan font saat dipilih
                            color: '#fff'  // Warna font label
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: 14,  // Ukuran font label saat dipilih
                                fontWeight: 'bold'  // Menebalkan font saat dipilih
                            }
                        },
                        labelLine: {
                            show: false  // Menyembunyikan garis label
                        },
                        data: data,  // Data untuk chart
                        bottom: '60px'
                    }
                ]
            };

            // Menetapkan opsi chart dan menampilkan grafik
            myChart.setOption(option);
        }

        function buildChartMetabolicSyndrome(chartDom, data) {
            chartDom = document.getElementById(chartDom);
            var myChart = echarts.init(chartDom);
            
            var option = {
                tooltip: {
                    trigger: 'item'  // Tipe tooltip yang muncul ketika item dipilih
                },
                legend: {
                    bottom: '0%',
                    left: 'center',
                    orient: 'horizontal',  // Orientasi horizontal
                    itemWidth: 10,  // Menentukan lebar ikon legend
                    itemHeight: 10,  // Menentukan tinggi ikon legend
                    textStyle: {
                        fontSize: 14  // Ukuran font untuk teks legenda
                    }
                },
                series: [
                    {
                        name: 'Kesehatan Peserta',
                        type: 'pie',  // Tipe grafik pie
                        radius: ['40%', '82%'],  // Mengatur jari-jari bagian dalam dan luar pie chart
                        avoidLabelOverlap: false,
                        label: {
                            show: true,  // Menampilkan label di dalam pie
                            position: 'inside',  // Menempatkan label di dalam potongan
                            formatter: '{c}',  // Hanya menampilkan nilai (angka)
                            fontSize: 14,  // Ukuran font untuk label
                            color: '#fff',  // Warna font label
                            fontWeight: 'bold' // Menebalkan font saat dipilih
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: 14,  // Ukuran font label saat dipilih
                                fontWeight: 'bold'  // Menebalkan font saat dipilih
                            }
                        },
                        labelLine: {
                            show: false  // Menyembunyikan garis label
                        },
                        data: [
                            { 
                                value: data.normal, 
                                name: 'Normal', 
                                itemStyle: {
                                    color: '#0F3B99'  // Warna biru tua untuk kategori Normal
                                }
                            },  // Data untuk kategori Normal
                            { 
                                value: data.abnormal, 
                                name: 'Abnormal', 
                                itemStyle: {
                                    color: '#5886E9'  // Warna biru muda untuk kategori Abnormal
                                }
                            }  // Data untuk kategori Abnormal
                        ],
                        bottom: '60px'  // Menempatkan pie chart lebih dekat ke bawah
                    }
                ]
            };

            // Menetapkan opsi chart dan menampilkan grafik
            myChart.setOption(option);
        }

        function buildChartSymptoms(chartDom, data) {
            var chartDom = document.getElementById('chart_gejala');
            var myChart = echarts.init(chartDom);

            // Ambil semua nama diagnosa yang ada
            const allDiagnoses = [...new Set(data.flatMap(item => Object.keys(item.diagnoses)))];

            // Mengurutkan data berdasarkan total diagnosa secara menurun
            data.forEach(item => {
              item.totalDiagnoses = Object.values(item.diagnoses).reduce((acc, value) => acc + value, 0);
            });

            data.sort((a, b) => b.totalDiagnoses - a.totalDiagnoses);

            var option = {
              tooltip: {
                trigger: 'axis',
                axisPointer: {
                  type: 'shadow'
                },
                formatter: (params) => {
                  let tooltipText = `${params[0].name}<br>`;
                  params.forEach(item => {
                    if (item.value > 0) {
                      tooltipText += `${item.marker} ${item.seriesName}: ${item.value}<br>`;
                    }
                  });
                  return tooltipText;
                }
              },
              grid: {
                left: '0%',
                right: '0%',
                bottom: '0%',
                top: '2%',
                containLabel: true
              },
              xAxis: {
                type: 'category',
                data: data.map(item => item.disease),
                axisLabel: {
                  rotate: 45,
                  fontSize: 12,
                  formatter: function (value) {
                    if (value.length > 10) {
                      return value.substring(0, 10) + '...';
                    }
                    return value;
                  }
                }
              },
              yAxis: {
                type: 'value'
              },
              series: allDiagnoses.map((diagnosisName, index) => ({
                name: diagnosisName,
                type: 'bar',
                stack: 'total',
                label: {
                  show: true,
                  position: 'inside',
                  formatter: (params) => {
                    let total = params.value;
                    if (total > 0) {
                      return total;
                    }
                    return '';
                  },
                  fontSize: 12,
                  color: '#fff'
                },
                emphasis: { focus: 'series' },
                itemStyle: {
                  color: ['#0F3B99', '#5886E9', '#FF9800', '#F44336', '#37CDC1'][index % 5]  // Warna berdasarkan urutan
                },
                data: data.map(item => item.diagnoses[diagnosisName] || 0)
              }))
            };

            myChart.setOption(option);
        }

        function getAllDataChart() {
            var program_id = $("#program_id").val();

            var url = "{{ route('get-all-data-chart', ':program_id') }}";
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        var genderData = response.data.gender;
                        var participantData = response.data.participant;
                        var ageData = response.data.age;
                        var healthCategoryData = response.data.health_category;
                        var metabolicSyndromeData = response.data.metabolic_syndrome;
                        var diseaseHistoryData = response.data.disease_history;
                        var labDiagnosisData = response.data.lab_diagnosis;
                        var nonLabDiagnosisData = response.data.non_lab_diagnosis;
                        var symptomsData = response.data.symptoms;
                        var conclusionAndRecommendationData = response.data.conclusion_and_recommendation;

                        buildChartMale("chart_male", genderData.male, genderData.total);
                        buildChartFemale("chart_female", genderData.female, genderData.total);
                        buildChartParticipant("chart_peserta", participantData);
                        buildChartAge("chart_usia", ageData);
                        buildChartHealthCategory("chart_kategori_kesehatan", healthCategoryData);
                        buildChartMetabolicSyndrome("chart_kategori_sindrom_metabolik", metabolicSyndromeData);
                        buildChartDiseaseHistory("chart_riwayat_penyakit", diseaseHistoryData);
                        buildChartLabDiagnosis("chart_riwayat_diagnosa_lab", labDiagnosisData);
                        buildChartNonLabDiagnosis("chart_riwayat_diagnosa_non_lab", nonLabDiagnosisData);
                        buildChartSymptoms("chart_gejala", symptomsData);

                        $('#conclusion').empty();
                        $('#recommendation').empty();
                        $('#conclusion').append(conclusionAndRecommendationData.conclusion);
                        $('#recommendation').append(conclusionAndRecommendationData.recommendation);
                    } else {
                        toastr.error('Gagal memuat data untuk semua chart');
                    }
                },
                error: function() {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }


    </script>
@endsection
