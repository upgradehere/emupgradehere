@extends('templates/template')
@section('content')
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                     <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-weight: 700;">Total</h3>
                            </div>
                          </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="small-box" style="background: linear-gradient(135deg, #17a2b8, #0c7a8d);box-shadow: none !important;">
                            <div class="inner text-white">
                                <p class="pl-0 mb-0">Pria</p>
                                <h3 id="male_total">150 / 150</h3>
                                <small>Peserta yang mengikuti Medical Check-Up</small>
                            </div>
                            <div class="icon">
                                <i class="fas fa-mars"></i>
                            </div>
                        </div>
                        <div class="small-box" style="background: linear-gradient(135deg, #e83e8c, #d6336c);box-shadow: none !important;">
                            <div class="inner text-white">
                                <p class="pl-0 mb-0">Wanita</p>
                                <h3 id="female_total">53 / 100</h3>
                                <small>Peserta yang mengikuti Medical Check-Up</small>
                            </div>
                            <div class="icon">
                                <i class="fas fa-venus"></i>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- AREA CHART -->
                    <div class="card">
                      <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title" style="font-weight: 700;">Demografi Peserta</h3>
                          <a href="javascript:void(0);">View</a>
                        </div>
                      </div>
                      <div class="card-body">
                        <div id="chart_peserta" style="width: 100%; height: 260px;"></div>
                      </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <!-- AREA CHART -->
                    <div class="card">
                      <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title" style="font-weight: 700;">Demografi Usia</h3>
                          <a href="javascript:void(0);">View</a>
                        </div>
                      </div>
                      <div class="card-body">
                        <div id="chart_usia" style="width: 100%; height: 260px;"></div>
                      </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-8">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-weight: 700;">10 Diagnosa Lab Terbanyak</h3>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="chart_riwayat_diagnosa_lab" style="width: 100%; height: 260px;"></div>
                          </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-weight: 700;">10 Diagnosa Non Lab Terbanyak</h3>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="chart_riwayat_diagnosa_non_lab" style="width: 100%; height: 260px;"></div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-weight: 700;">10 Riwayat Penyakit Terbanyak</h3>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="chart_riwayat_penyakit" style="width: 100%; height: 620px;"></div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                      <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                          <h3 class="card-title" style="font-weight: 700;">Kategori Kesehatan Peserta</h3>
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
                          <h3 class="card-title" style="font-weight: 700;">Kategori Kesehatan Peserta</h3>
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
                              <h3 class="card-title" style="font-weight: 700;">Indikator Gejala Sindrom Metabolik</h3>
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
                              <h3 class="card-title" style="font-weight: 700;">Kesimpulan</h3>
                            </div>
                          </div>
                          <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="w-100">
                        <div class="card">
                          <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-weight: 700;">Saran</h3>
                            </div>
                          </div>
                          <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
            var dataPeserta = [
                { name: 'Pemeriksaan Jantung', pria: 120, wanita: 150 },
                { name: 'Pemeriksaan Mata', pria: 132, wanita: 182 },
                { name: 'Vaksinasi', pria: 101, wanita: 180 },
                { name: 'Pemeriksaan Gigi', pria: 134, wanita: 210 },
                { name: 'Konsultasi Kesehatan', pria: 90, wanita: 240 },
                { name: 'Pemeriksaan Kulit', pria: 230, wanita: 270 },
                { name: 'Cek Kolesterol', pria: 210, wanita: 230 },
                { name: 'Pemeriksaan Darah', pria: 100, wanita: 170 },
                { name: 'Tes Diabetes', pria: 80, wanita: 160 },
                { name: 'Tes COVID-19', pria: 110, wanita: 200 },
                { name: 'Pemeriksaan Paru-paru', pria: 95, wanita: 220 },
                { name: 'Cek Tekanan Darah', pria: 160, wanita: 250 },
                { name: 'Pemeriksaan Telinga', pria: 135, wanita: 245 },
                { name: 'Tes Kolesterol', pria: 125, wanita: 165 },
                { name: 'Pemeriksaan Ginjal', pria: 140, wanita: 180 },
                { name: 'Cek Mata', pria: 150, wanita: 210 },
                { name: 'Pemeriksaan THT', pria: 110, wanita: 190 },
                { name: 'Tes Fungsi Hati', pria: 115, wanita: 160 },
                { name: 'Pemeriksaan Stamina', pria: 180, wanita: 210 },
                { name: 'Vaksinasi Flu', pria: 160, wanita: 220 },
                { name: 'Pemeriksaan Kesehatan Mental', pria: 100, wanita: 160 },
                { name: 'Cek Kesehatan Jantung', pria: 200, wanita: 250 },
                { name: 'Pemeriksaan Endokrin', pria: 105, wanita: 190 },
                { name: 'Tes COVID-19 Rapid', pria: 130, wanita: 210 },
                { name: 'Pemeriksaan Diet', pria: 95, wanita: 170 },
                { name: 'Pemeriksaan Kesehatan Reproduksi', pria: 90, wanita: 220 },
                { name: 'Cek Gula Darah', pria: 145, wanita: 200 },
                { name: 'Pemeriksaan Gizi', pria: 120, wanita: 180 },
                { name: 'Pemeriksaan Imunisasi', pria: 105, wanita: 145 },
                { name: 'Cek Kesehatan Gigi', pria: 110, wanita: 185 }
            ];


            var chartDom = document.getElementById('chart_peserta');
            buildChartPeserta(chartDom, dataPeserta);


            var dataUsia = [
                { name: "<25", pria: 40, wanita: 60 },
                { name: "26-35", pria: 70, wanita: 90 },
                { name: "36-45", pria: 50, wanita: 80 },
                { name: "46-55", pria: 30, wanita: 50 },
                { name: ">55", pria: 20, wanita: 40 }
            ];

            var chartDom = document.getElementById('chart_usia');
            buildChartUsia(chartDom, dataUsia);


            var data = [
                { value: 1048, name: 'Fit with Note' },
                { value: 735, name: 'Fit to Work' },
                { value: 580, name: 'Temporary Unfit' },
                { value: 484, name: 'nan' }
            ];

            var chartDom = document.getElementById('chart_kategori_kesehatan');
            buildChartKategoryKesehatan(chartDom, data);

            var data = {
                normal: 70,  // Jumlah peserta yang normal
                abnormal: 30  // Jumlah peserta yang abnormal
            };

            var chartDom = document.getElementById('chart_kategori_sindrom_metabolik');
            buildChartSindromMetabolik(chartDom, data);

            var data = [
                { name: 'Diabetes Mellitus', jumlah_diagnosa: 150 },
                { name: 'Hipertensi', jumlah_diagnosa: 200 },
                { name: 'Jantung', jumlah_diagnosa: 120 },
                { name: 'Gastritis', jumlah_diagnosa: 90 },
                { name: 'Asma', jumlah_diagnosa: 85 },
                { name: 'Pneumonia', jumlah_diagnosa: 75 },
                { name: 'Stroke', jumlah_diagnosa: 110 },
                { name: 'Kanker Paru-paru', jumlah_diagnosa: 50 },
                { name: 'Penyakit Ginjal', jumlah_diagnosa: 60 },
                { name: 'Infeksi Saluran Pernafasan', jumlah_diagnosa: 140 }
            ];

            var chartDom = document.getElementById('chart_riwayat_penyakit');
            buildChartRiwayatPenyakit(chartDom, data);


            var data = [
                { name: 'Darah Lengkap', pria: 150, wanita: 120 },
                { name: 'Fungsi Hati', pria: 80, wanita: 70 },
                { name: 'Kolesterol', pria: 110, wanita: 90 },
                { name: 'Gula Darah', pria: 130, wanita: 100 },
                { name: 'Fungsi Ginjal', pria: 95, wanita: 85 },
                { name: 'Hepatitis', pria: 60, wanita: 50 },
                { name: 'Urine', pria: 140, wanita: 110 },
                { name: 'Kanker', pria: 70, wanita: 60 },
                { name: 'HIV', pria: 40, wanita: 35 },
                { name: 'TBC', pria: 55, wanita: 45 }
            ];


            var chartDom = document.getElementById('chart_riwayat_diagnosa_lab');
            buildChartDiagnosaLab(chartDom, data);

            var data = [
                { name: 'Tes Fungsi Kardiovaskular', abnormal: 150 },
                { name: 'Tes Fungsi Hati Metabolik', abnormal: 50 },
                { name: 'Tes Profil Lipid Kompleks', abnormal: 90 },
                { name: 'Tes Gula Darah Puasa', abnormal: 120 },
                { name: 'Tes Fungsi Ginjal Dinamis', abnormal: 70 },
                { name: 'Tes Hepatitis B & C', abnormal: 30 },
                { name: 'Tes Urinalisis Lengkap', abnormal: 110 },
                { name: 'Tes Onkologi: Kanker Genetik', abnormal: 40 },
                { name: 'Tes HIV dan Imunologi', abnormal: 15 },
                { name: 'Tes Screening TBC', abnormal: 20 }
            ];
            var chartDom = document.getElementById('chart_riwayat_diagnosa_non_lab');
            buildChartDiagnosaNonLab(chartDom, data);

            var data = [
              {
                disease: 'Diabetes',
                diagnoses: {
                  'Diagnosis Awal': 320,
                  'Pemeriksaan Lanjutan': 120,
                  'Rekomendasi Pengobatan': 220
                }
              },
              {
                disease: 'Hipertensi',
                diagnoses: {
                  'Diagnosis Awal': 302,
                  'Pemeriksaan Lanjutan': 132,
                  'Rekomendasi Pengobatan': 182,
                  'Tindak Lanjut': 212
                }
              },
              {
                disease: 'Asma',
                diagnoses: {
                  'Diagnosis Awal': 301,
                  'Pemeriksaan Lanjutan': 101
                }
              },
              {
                disease: 'Penyakit Jantung',
                diagnoses: {
                  'Diagnosis Awal': 334,
                  'Pemeriksaan Lanjutan': 134,
                  'Rekomendasi Pengobatan': 234,
                  'Tindak Lanjut': 154,
                  'Saran Diet': 934
                }
              },
              {
                disease: 'Kanker',
                diagnoses: {
                  'Diagnosis Awal': 390,
                  'Pemeriksaan Lanjutan': 90,
                  'Rekomendasi Pengobatan': 290
                }
              },
              {
                disease: 'Stroke',
                diagnoses: {
                  'Diagnosis Awal': 330,
                  'Pemeriksaan Lanjutan': 230,
                  'Rekomendasi Pengobatan': 330,
                  'Tindak Lanjut': 330
                }
              },
              {
                disease: 'Penyakit Ginjal',
                diagnoses: {
                  'Diagnosis Awal': 320,
                  'Pemeriksaan Lanjutan': 210,
                  'Rekomendasi Pengobatan': 310,
                  'Tindak Lanjut': 410,
                  'Saran Diet': 1320
                }
              }
            ];

            var chartDom = document.getElementById('chart_gejala');
            buildChartGejala(chartDom, data);
        })

        $(document).on("change", "#program_id", function() {
            getChartData();
        });

        function buildChartPeserta(chartDom, data) {
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
                                color: '#17a2b8'  // Warna saat hover untuk Pria
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
                            color: '#17a2b8'  // Warna untuk batang Pria
                        },
                        data: data.map(item => item.pria)  // Ambil data pria dari data
                    },
                    {
                        name: 'Wanita',
                        type: 'bar',
                        stack: 'Gender',
                        emphasis: {
                            itemStyle: {
                                color: '#e83e8c'  // Warna saat hover untuk Wanita
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
                            color: '#e83e8c'  // Warna untuk batang Wanita
                        },
                        data: data.map(item => item.wanita)  // Ambil data wanita dari data
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

        function buildChartUsia(chartDom, data) {
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
                    bottom: '10%',  // Memberikan ruang lebih di bawah untuk legend
                    containLabel: true
                },
                yAxis: [
                    {
                        type: 'category',
                        data: data.map(item => item.name),  // Ambil nama dari data
                        axisLabel: {
                            rotate: 0,
                            interval: 0,
                            formatter: function (value) {
                                return value.length > 10 ? value.slice(0, 5) + '...' : value;
                            }
                        }
                    }
                ],
                xAxis: [
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
                                color: '#17a2b8'
                            }
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: function(params) {
                                return params.value;
                            },
                            color: '#fff'
                        },
                        itemStyle: {
                            color: '#17a2b8'
                        },
                        barWidth: 20,  // Mengatur lebar batang untuk "Pria"
                        data: data.map(item => item.pria)
                    },
                    {
                        name: 'Wanita',
                        type: 'bar',
                        stack: 'Gender',
                        emphasis: {
                            itemStyle: {
                                color: '#e83e8c'
                            }
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: function(params) {
                                return params.value;
                            },
                            color: '#fff'
                        },
                        itemStyle: {
                            color: '#e83e8c'
                        },
                        barWidth: 20,  // Mengatur lebar batang untuk "Wanita"
                        data: data.map(item => item.wanita)
                    }
                ],
                legend: {
                    data: ['Pria', 'Wanita'],  // Menambahkan label untuk "Pria" dan "Wanita"
                    bottom: '0',  // Menempatkan legend di bagian bawah
                    left: 'center',  // Menempatkan legend di tengah horizontal
                    textStyle: {
                        fontSize: 14,  // Ukuran font untuk legend
                        color: '#333'  // Warna font legend
                    },
                    itemWidth: 10,  // Lebar item legend
                    itemHeight: 10, // Tinggi item legend
                    itemStyle: {
                        borderRadius: '50%'  // Membuat item legend berbentuk bulat
                    }
                }
            };

            // Set opsi dan tampilkan grafik
            myChart.setOption(option);
        }

        function buildChartKategoryKesehatan(chartDom, data) {
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
                        radius: ['40%', '70%'],  // Mengatur jari-jari bagian dalam dan luar pie chart
                        avoidLabelOverlap: false,
                        label: {
                            show: true,  // Menampilkan label di dalam pie
                            position: 'inside',  // Menempatkan label di dalam potongan
                            formatter: '{c}',  // Hanya menampilkan nilai (angka)
                            fontSize: 14,  // Ukuran font untuk label
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
                        data: data,
                        bottom: '20px'
                    }
                ]
            };

            // Menetapkan opsi chart dan menampilkan grafik
            myChart.setOption(option);
        }

        function buildChartSindromMetabolik(chartDom, data) {
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
                        radius: ['40%', '70%'],  // Mengatur jari-jari bagian dalam dan luar pie chart
                        avoidLabelOverlap: false,
                        label: {
                            show: true,  // Menampilkan label di dalam pie
                            position: 'inside',  // Menempatkan label di dalam potongan
                            formatter: '{c}',  // Hanya menampilkan nilai (angka)
                            fontSize: 14,  // Ukuran font untuk label
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
                        data: [
                            { value: data.normal, name: 'Normal' },  // Data untuk kategori Normal
                            { value: data.abnormal, name: 'Abnormal' }  // Data untuk kategori Abnormal
                        ],
                        bottom: '20px'  // Menempatkan pie chart lebih dekat ke bawah
                    }
                ]
            };

            // Menetapkan opsi chart dan menampilkan grafik
            myChart.setOption(option);
        }

        function buildChartRiwayatPenyakit(chartDom, data) {
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
                        // Custom tooltip formatter to display the name and jumlah_diagnosa
                        var data = params[0].data;
                        return `${data.name}<br/>Jumlah Diagnosa: ${data.jumlah_diagnosa}`;
                    }
                },
                dataset: [
                    {
                        dimensions: ['name', 'jumlah_diagnosa'],
                        source: data  // Using the passed data as parameter
                    },
                    {
                        transform: {
                            type: 'sort',
                            config: { dimension: 'jumlah_diagnosa', order: 'asc' }
                        }
                    }
                ],
                
                xAxis: {
                    type: 'value', // Change to value to represent the jumlah_diagnosa on the X-axis
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
                    encode: { x: 'jumlah_diagnosa', y: 'name' }, // Swap x and y encoding for horizontal chart
                    datasetIndex: 1,
                    itemStyle: {
                        // Gradient effect using a darker color at the top and lighter color at the bottom
                        color: new echarts.graphic.LinearGradient(
                            0, 0, 1, 0, // Horizontal gradient (from left to right)
                            [
                                { offset: 0, color: '#084c54' },  // Darker color at the left
                                { offset: 1, color: '#0c7a8d' }   // Lighter color at the right
                            ]
                        )
                    },
                    label: {
                        show: true,
                        position: 'inside',  // Position the label inside the bar
                        formatter: function (params) {
                            return params.data.jumlah_diagnosa;  // Show the diagnosis count inside the bar
                        },
                        fontSize: 14,  // Font size for the label
                        color: '#fff'  // Color of the label
                    }
                }
            };

            // Set options and render the chart
            myChart.setOption(option);
        }

        function buildChartDiagnosaLab(chartDom, data) {
            var myChart = echarts.init(chartDom);

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
                            Pria: ${data.pria}<br/>
                            Wanita: ${data.wanita}<br/>
                            <strong>Total: ${data.total}</strong>
                        `;
                    }
                },
                dataset: [
                    {
                        dimensions: ['name', 'pria', 'wanita', 'total'],
                        source: data.map(item => ({
                            name: item.name,
                            pria: item.pria,
                            wanita: item.wanita,
                            total: item.pria + item.wanita  // Menambahkan kolom total yang merupakan jumlah pria + wanita
                        }))
                    },
                    {
                        transform: {
                            type: 'sort',
                            config: { dimension: 'total', order: 'desc' }  // Mengurutkan berdasarkan total diagnosa
                        }
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
                        name: 'Total',  // Series untuk jumlah total (pria + wanita)
                        type: 'bar',
                        encode: { x: 'name', y: 'total' },
                        itemStyle: {
                            // Gradient color for bars (from yellow to dark yellow)
                            color: {
                                type: 'linear',
                                x: 0, y: 0, x2: 0, y2: 1,  // Gradient goes vertically from top to bottom
                                colorStops: [
                                    { offset: 0, color: '#fac858' },  // Light yellow at the top
                                    { offset: 1, color: '#f39c12' }   // Dark yellow at the bottom
                                ],
                                global: false  // Local gradient
                            }
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: function (params) {
                                return params.data.total;  // Menampilkan jumlah total diagnosa di dalam batang
                            },
                            fontSize: 14,
                            color: '#fff'
                        }
                    }
                ]
            };

            // Set options and render the chart
            myChart.setOption(option);
        }

        function buildChartDiagnosaNonLab(chartDom, data) {
            var myChart = echarts.init(chartDom);

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
                    },
                    {
                        transform: {
                            type: 'sort',
                            config: { dimension: 'abnormal', order: 'desc' }
                        }
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
                            color: {
                                type: 'linear',
                                x: 0, y: 0, x2: 0, y2: 1,
                                colorStops: [
                                    { offset: 0, color: '#478A3D' },  // Darker green at the top
                                    { offset: 1, color: '#91cc75' }   // Lighter green at the bottom
                                ]
                            }
                        },
                        label: {
                            show: true,
                            position: 'inside',
                            formatter: function (params) {
                                return params.data.abnormal;
                            },
                            fontSize: 14,
                            color: '#fff'
                        }
                    }
                ]
            };

            myChart.setOption(option);
        }

        function buildChartGejala(chartDom, data) {
            var myChart = echarts.init(chartDom);

            // Ambil semua nama diagnosa yang ada
            const allDiagnoses = [...new Set(data.flatMap(item => Object.keys(item.diagnoses)))];

            // Mengurutkan data berdasarkan total diagnosa secara menurun
            data.forEach(item => {
              // Menambahkan properti total untuk menghitung total dari semua diagnosa pada penyakit ini
              item.totalDiagnoses = Object.values(item.diagnoses).reduce((acc, value) => acc + value, 0);
            });

            // Mengurutkan data berdasarkan total diagnosa secara menurun
            data.sort((a, b) => b.totalDiagnoses - a.totalDiagnoses);

            var option = {
              tooltip: {
                trigger: 'axis',
                axisPointer: {
                  type: 'shadow' // 'shadow' as default; can also be 'line' or 'shadow'
                },
                formatter: (params) => {
                  let tooltipText = `${params[0].name}<br>`; // Menampilkan nama penyakit (xAxis)
                  params.forEach(item => {
                    if (item.value > 0) { // Menampilkan tooltip hanya jika nilai > 0
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
                type: 'category', // Mengubah xAxis menjadi kategori (yAxis sebelumnya)
                data: data.map(item => item.disease), // Nama penyakit sebagai kategori di sumbu X
                axisLabel: {
                  rotate: 45,  // Rotasi label agar tidak terpotong
                  fontSize: 12,
                  formatter: function (value) {
                    // Potong label jika panjangnya lebih dari 10 karakter
                    if (value.length > 10) {
                      return value.substring(0, 10) + '...'; // Potong dan tambahkan elipsis
                    }
                    return value;
                  }
                }
              },
              yAxis: {
                type: 'value' // Mengubah yAxis menjadi nilai (sebelumnya kategori)
              },
              series: allDiagnoses.map((diagnosisName) => ({
                name: diagnosisName,
                type: 'bar',
                stack: 'total',
                label: {
                  show: true,
                  position: 'inside', // Menempatkan label di dalam bar (dalam stack bar)
                  formatter: (params) => {
                    // Menampilkan total di tengah bar
                    let total = params.value;
                    if (total > 0) {
                      return total; // Tampilkan nilai total di dalam bar
                    }
                    return ''; // Tidak menampilkan label jika tidak ada nilai
                  },
                  fontSize: 12, // Atur ukuran font agar lebih kecil jika diperlukan
                  color: '#fff' // Ubah warna label menjadi putih agar terlihat jelas di dalam bar
                },
                emphasis: { focus: 'series' },
                data: data.map(item => item.diagnoses[diagnosisName] || 0)
              }))
            };

            myChart.setOption(option);
          }

        function getChartData() {
            var url = "{{ route('get-chart-data', ':program_id') }}";
            var program_id = $("#program_id").val();
            url = url.replace(":program_id", program_id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.status == 'error') {

                    } else if (response.status == 'success') {
                        $("#male_total").text(response.data.male + " / " + response.data.total)
                        $("#female_total").text(response.data.female + " / " + response.data.total)
                    }
                },
                error: function(response) {
                    toastr.error('Kesalahan terjadi, harap hubungi Admin kami')
                }
            });
        }
    </script>
@endsection
