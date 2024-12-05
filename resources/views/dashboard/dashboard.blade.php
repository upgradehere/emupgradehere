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
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="program_id" id="program_id">
                        @foreach ($programs as $key => $program)
                            <option {{ $key == 0 ? 'selected' : '' }} value="{{ $program->mcu_program_id }}">
                                {{ $program->mcu_program_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
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
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-left pt-3">
                                    <div class="gender-label">Pria</div>
                                    <h3 class="gender-number" id="male_total">0/0</h3> <!-- Menampilkan total peserta pria -->
                                    <p class="gender-description">Peserta yang mengikuti medical cek up</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-left pt-3">
                                    <div class="gender-label">Wanita</div>
                                    <h3 class="gender-number" id="female_total">0/0</h3>
                                    <p class="gender-description">Peserta yang mengikuti medical cek up</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="col-md-4">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title fw-700">10 Riwayat Penyakit Terbanyak</h3>
                              <a href="javascript:void(0);" class="text-dark"><i class="fas fa-external-link-alt"></i></a>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="chart_riwayat_penyakit" style="width: 100%; height: 703px;"></div>
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
                          <div class="card-body" id="conclusion">Belum terdapat kesimpulan!
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
                          <div class="card-body" id="recommendation">Belum terdapat saran!
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
        getGender();
        getAge()
        getParticipant()
        getDiseaseHistory()
        getLabDiagnosis()
        getNonLabDiagnosis()
        getHealthCategory()
        getMetabolicSyndrome()
        getSymptoms()
        getConclusionAndRecommendation()

        $(document).on("change", "#program_id", function() {
            getGender();
            getAge()
            getParticipant()
            getDiseaseHistory()
            getLabDiagnosis()
            getNonLabDiagnosis()
            getHealthCategory()
            getMetabolicSyndrome()
            getSymptoms()
            getConclusionAndRecommendation()
        });

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
                grid: {
                    left: '20%',  // Remove left margin
                    right: '5%', // Remove right margin
                    top: '1%',   // Remove top margin
                    bottom: '5%' // Remove bottom margin
                },
                tooltip: {
                    trigger: 'axis',  // Trigger tooltip on axis
                    axisPointer: {
                        type: 'shadow'  // Show the shadow pointer on bars
                    },
                    formatter: function (params) {
                        // Custom tooltip formatter to display the name and diagnosis_count
                        var data = params[0].data;
                        return `${data.name}<br/>Jumlah Diagnosa: ${data.diagnosis_count}`;
                    }
                },
                dataset: [
                    {
                        dimensions: ['name', 'diagnosis_count'],
                        source: data  // Using the passed data as parameter
                    },
                    {
                        transform: {
                            type: 'sort',
                            config: { dimension: 'diagnosis_count', order: 'asc' }
                        }
                    }
                ],
                
                xAxis: {
                    type: 'value', // Change to value to represent the diagnosis_count on the X-axis
                    axisLabel: {
                        formatter: function (value) {
                            return value;  // Show the diagnosis count on the X-axis
                        }
                    }
                },
                yAxis: {
                    type: 'category', // Change to category to represent disease names on the Y-axis
                    axisLabel: {
                        interval: 0,  // Show all y-axis labels
                        formatter: function (value) {
                            // Truncate label text if it is too long and add ellipsis
                            return value.length > 8 ? value.slice(0, 8) + '...' : value;
                        },
                    }
                },
                series: {
                    type: 'bar',
                    encode: { x: 'diagnosis_count', y: 'name' }, // Swap x and y encoding for horizontal chart
                    datasetIndex: 1,
                    itemStyle: {
                        // Solid color for bars with a dark blue shade
                        color: '#0F3B99'  // Dark blue color
                    },
                    label: {
                        show: true,
                        position: 'inside',  // Position the label inside the bar
                        formatter: function (params) {
                            return params.data.diagnosis_count;  // Show the diagnosis count inside the bar
                        },
                        fontSize: 14,  // Font size for the label
                        fontWeight: 'bold',  // Make the label text bold
                        color: '#fff'  // Color of the label
                    }
                }
            };

            // Set options and render the chart
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
                            return value.length > 10 ? value.slice(0, 10) + '...' : value;
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

        function getGender() {
            var url = "{{ route('get-gender', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {

                    } else if (response.status == 'success') {
                        $("#male_total").html(response.data.male + " <span class='gender-total'>/ " + response.data.total + "</span>")
                        $("#female_total").html(response.data.female + " <span class='gender-total'>/  " + response.data.total + "</span>")
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami')
                }
            });
        }

        function getParticipant() {
            var url = "{{ route('get-participant', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        dataPeserta = response.data;
                        buildChartParticipant('chart_peserta', dataPeserta);
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

        function getAge() {
            var url = "{{ route('get-age', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        dataUsia = response.data;
                        buildChartAge('chart_usia', dataUsia);
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

        function getDiseaseHistory() {
            var program_id = $("#program_id").val();
            var url = "{{ route('get-disease-history', ':program_id') }}";
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        dataDiseaseHistory = response.data;
                        buildChartDiseaseHistory('chart_riwayat_penyakit', dataDiseaseHistory);
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

        function getLabDiagnosis() {
            var url = "{{ route('get-lab-diagnosis', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        // handle success, use response.data
                        dataLabDiagnosis = response.data;
                        buildChartLabDiagnosis('chart_riwayat_diagnosa_lab', dataLabDiagnosis);
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

        function getNonLabDiagnosis() {
            var url = "{{ route('get-non-lab-diagnosis', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        // handle success, use response.data
                        dataNonLabDiagnosis = response.data;
                        buildChartNonLabDiagnosis('chart_riwayat_diagnosa_non_lab', dataNonLabDiagnosis);
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

        function getHealthCategory() {
            var url = "{{ route('get-health-category', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        dataHealthCategory = response.data;
                        buildChartHealthCategory('chart_kategori_kesehatan',dataHealthCategory);
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

        function getMetabolicSyndrome() {
            var url = "{{ route('get-metabolic-syndrome', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        dataMetabolicSyndrome = response.data;
                        buildChartMetabolicSyndrome('chart_kategori_sindrom_metabolik',dataMetabolicSyndrome);
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

        function getSymptoms() {
            var url = "{{ route('get-symptoms', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        // handle success, use response.data
                        dataSymptoms = response.data;
                        console.log(dataSymptoms)
                        buildChartSymptoms('chart_gejala', dataSymptoms);
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

        function getConclusionAndRecommendation() {
            var url = "{{ route('get-conclusion-recommendation', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {
                        // handle error
                    } else if (response.status == 'success') {
                        // handle success, use response.data
                        var conclusion =  response.data.conclusion;
                        var recommendation =  response.data.recommendation;
                        $('#conclusion').empty();
                        $('#recommendation').empty();
                        $('#conclusion').append(conclusion)
                        $('#recommendation').append(recommendation)
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami');
                }
            });
        }

    </script>
@endsection
