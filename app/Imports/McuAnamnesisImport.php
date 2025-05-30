<?php

namespace App\Imports;

use App\Models\AnamnesisT;
use App\Models\DoctorM;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuAnamnesisImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $rps = self::mappingMedicalHistory()['id'];
        $rps_en = self::mappingMedicalHistory()['en'];
        $riwayatPenyakit = [];

        $hf = self::mappingHabitFactor()['id'];
        $hf_en = self::mappingHabitFactor()['en'];
        $faktorKebiasaan = [];

        $whh = self::mappingWorkHazardHistory()['id'];
        $whh_en = self::mappingWorkHazardHistory()['en'];
        $riwayatHazardLingkunganKerja = [];

        $mata = self::mappingEyes()['id'];
        $mata_en = self::mappingEyes()['en'];
        $fisikMata = [];

        $telinga = self::mappingEars()['id'];
        $telinga_en = self::mappingEars()['en'];
        $fisikTelinga = [];

        $hidung = self::mappingNose()['id'];
        $hidung_en = self::mappingNose()['en'];
        $fisikHidung = [];

        $rongga_mulut = self::mappingOralCavity()['id'];
        $rongga_mulut_en = self::mappingOralCavity()['en'];
        $fisikRonggaMulut = [];

        $gigi = self::mappingTeeth()['id'];
        $gigi_en = self::mappingTeeth()['en'];
        $fisikGigi = [];

        $leher = self::mappingNeck()['id'];
        $leher_en = self::mappingNeck()['en'];
        $fisikLeher = [];

        $thorax = self::mappingThorax()['id'];
        $thorax_en = self::mappingThorax()['en'];
        $fisikThorax = [];

        $abdomen = self::mappingAbdomen()['id'];
        $abdomen_en = self::mappingAbdomen()['en'];
        $fisikAbdomen = [];

        $tulang_belakang = self::mappingSpine()['id'];
        $tulang_belakang_en = self::mappingSpine()['en'];
        $fisikTulangBelakang = [];

        $ekstremitas_atas = self::mappingUpperExtremities()['id'];
        $ekstremitas_atas_en = self::mappingUpperExtremities()['en'];
        $fisikEkstremitasAtas = [];

        $ekstremitas_bawah = self::mappingLowerExtremities()['id'];
        $ekstremitas_bawah_en = self::mappingLowerExtremities()['en'];
        $fisikEkstremitasBawah = [];

        DB::beginTransaction();

        foreach ($collection as $row)
        {
            Log::info($row);
            // Riwayat penyakit sebelumnya
            foreach ($rps as $index => $r) {
                if ($r == 'catatan_riwayat_operasi' || $r == 'catatan_epilepsi' || $r == 'keluhan_utama') {
                    $riwayatPenyakit[$rps_en[$index]] = isset($row["riwayat_penyakit_sebelumnya_$r"]) ? $row["riwayat_penyakit_sebelumnya_$r"] : '';
                } else {
                    $riwayatPenyakit[$rps_en[$index]] = isset($row["riwayat_penyakit_sebelumnya_$r"]) && $row["riwayat_penyakit_sebelumnya_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Faktor kebiasaan
            foreach ($hf as $index => $r) {
                if ($r == 'merokok') {
                    if (isset($row["faktor_kebiasaan_$r"])) {
                        if ($row["faktor_kebiasaan_$r"] == 'Tidak') {
                            $faktorKebiasaan[$hf_en[$index]] = 0;
                        } elseif ($row["faktor_kebiasaan_$r"] == 'Kadang-Kadang') {
                            $faktorKebiasaan[$hf_en[$index]] = 1;
                        } elseif ($row["faktor_kebiasaan_$r"] == 'Aktif') {
                            $faktorKebiasaan[$hf_en[$index]] = 2;
                        } else {
                            $faktorKebiasaan[$hf_en[$index]] = 0;
                        }
                    }
                } elseif ($r == 'olahraga') {
                    if (isset($row["faktor_kebiasaan_$r"])) {
                        if ($row["faktor_kebiasaan_$r"] == 'Jarang Olahraga') {
                            $faktorKebiasaan[$hf_en[$index]] = 0;
                        } elseif ($row["faktor_kebiasaan_$r"] == 'Teratur Setiap 1 Minggu') {
                            $faktorKebiasaan[$hf_en[$index]] = 1;
                        } elseif ($row["faktor_kebiasaan_$r"] == 'Teratur Setiap 2 Minggu') {
                            $faktorKebiasaan[$hf_en[$index]] = 2;
                        } else {
                            $faktorKebiasaan[$hf_en[$index]] = 0;
                        }
                    }
                } elseif ($r == 'alkohol') {
                    $faktorKebiasaan[$hf_en[$index]] = isset($row["faktor_kebiasaan_$r"]) && $row["faktor_kebiasaan_$r"] == 'Ya' ? 1 : 0;
                } elseif ($r == 'alkohol_berapa_kali') {
                    $faktorKebiasaan[$hf_en[$index]] = isset($row["faktor_kebiasaan_$r"]) ? $row["faktor_kebiasaan_$r"] : '';
                }
            }

            // Riwayat hazard lingkungak kerja
            foreach ($whh as $index => $r) {
                if (isset($row["riwayat_hazard_lingkungan_kerja_$r"]) && ($row["riwayat_hazard_lingkungan_kerja_$r"] == 'Ya' || $row["riwayat_hazard_lingkungan_kerja_$r"] == 'Tidak')) {
                    $riwayatHazardLingkunganKerja[$whh_en[$index]] = isset($row["riwayat_hazard_lingkungan_kerja_$r"]) && $row["riwayat_hazard_lingkungan_kerja_$r"] == 'Ya' ? 1 : 0;
                } else {
                    $riwayatHazardLingkunganKerja[$whh_en[$index]] = isset($row["riwayat_hazard_lingkungan_kerja_$r"]) ? $row["riwayat_hazard_lingkungan_kerja_$r"] : '';
                }
            }

            // Mata
            foreach ($mata as $index => $r) {
                if ($r == 'visus_od' || $r == 'visus_os' || $r == 'strabismus_od' || $r == 'strabismus_os' || $r == 'strabismus_od' || $r == 'catatan_kelainan_kelenjar_mata' || $r == 'lain_lain') {
                    $fisikMata[$mata_en[$index]] = isset($row["mata_$r"]) ? $row["mata_$r"] : '';
                } else {
                    $fisikMata[$mata_en[$index]] = isset($row["mata_$r"]) && $row["mata_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Telinga
            foreach ($telinga as $index => $r) {
                if ($r == 'lain_lain') {
                    $fisikTelinga[$telinga_en[$index]] = isset($row["telinga_$r"]) ? $row["telinga_$r"] : '';
                } else {
                    $fisikTelinga[$telinga_en[$index]] = isset($row["telinga_$r"]) && $row["telinga_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Hidung
            foreach ($hidung as $index => $r) {
                if ($r == 'lain_lain') {
                    $fisikHidung[$hidung_en[$index]] = isset($row["hidung_$r"]) ? $row["hidung_$r"] : '';
                } else {
                    $fisikHidung[$hidung_en[$index]] = isset($row["hidung_$r"]) && $row["hidung_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Rongga Mulut
            foreach ($rongga_mulut as $index => $r) {
                if ($r == 'lain_lain') {
                    $fisikRonggaMulut[$rongga_mulut_en[$index]] = isset($row["rongga_mulut_$r"]) ? $row["rongga_mulut_$r"] : '';
                } else {
                    $fisikRonggaMulut[$rongga_mulut_en[$index]] = isset($row["rongga_mulut_$r"]) && $row["rongga_mulut_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Gigi
            foreach ($gigi as $index => $r) {
                if ($r == 'lain_lain') {
                    $fisikGigi[$gigi_en[$index]] = isset($row["gigi_$r"]) ? $row["gigi_$r"] : '';
                } else {
                    $fisikGigi[$gigi_en[$index]] = isset($row["gigi_$r"]) && $row["gigi_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Leher
            foreach ($leher as $index => $r) {
                if ($r == 'lain_lain') {
                    $fisikLeher[$leher_en[$index]] = isset($row["leher_$r"]) ? $row["leher_$r"] : '';
                } else {
                    $fisikLeher[$leher_en[$index]] = isset($row["leher_$r"]) && $row["leher_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Thorax
            foreach ($thorax as $index => $r) {
                if ($r == 'catatan_kelainan_paru' || $r == 'catatan_kelainan_jantung' || $r == 'lain_lain') {
                    $fisikThorax[$thorax_en[$index]] = isset($row["thorax_$r"]) ? $row["thorax_$r"] : '';
                } else {
                    $fisikThorax[$thorax_en[$index]] = isset($row["thorax_$r"]) && $row["thorax_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Abdomen
            foreach ($abdomen as $index => $r) {
                if ($r == 'catatan_bekas_operasi' || $r == 'lain_lain') {
                    $fisikAbdomen[$abdomen_en[$index]] = isset($row["abdomen_$r"]) ? $row["abdomen_$r"] : '';
                } else {
                    $fisikAbdomen[$abdomen_en[$index]] = isset($row["abdomen_$r"]) && $row["abdomen_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Tulang Belakang
            foreach ($tulang_belakang as $index => $r) {
                if ($r == 'lain_lain') {
                    $fisikTulangBelakang[$tulang_belakang_en[$index]] = isset($row["tulang_belakang_$r"]) ? $row["tulang_belakang_$r"] : '';
                } else {
                    $fisikTulangBelakang[$tulang_belakang_en[$index]] = isset($row["tulang_belakang_$r"]) && $row["tulang_belakang_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Ekstremitas Atas
            foreach ($ekstremitas_atas as $index => $r) {
                if ($r == 'lain_lain') {
                    $fisikEkstremitasAtas[$ekstremitas_atas_en[$index]] = isset($row["ekstremitas_atas_$r"]) ? $row["ekstremitas_atas_$r"] : '';
                } else {
                    $fisikEkstremitasAtas[$ekstremitas_atas_en[$index]] = isset($row["ekstremitas_atas_$r"]) && $row["ekstremitas_atas_$r"] == 'Ya' ? 1 : 0;
                }
            }

            // Ekstremitas Bawah
            foreach ($ekstremitas_bawah as $index => $r) {
                if ($r == 'lain_lain') {
                    $fisikEkstremitasBawah[$ekstremitas_bawah_en[$index]] = isset($row["ekstremitas_bawah_$r"]) ? $row["ekstremitas_bawah_$r"] : '';
                } else {
                    $fisikEkstremitasBawah[$ekstremitas_bawah_en[$index]] = isset($row["ekstremitas_bawah_$r"]) && $row["ekstremitas_bawah_$r"] == 'Ya' ? 1 : 0;
                }
            }

            $modelMcu = McuT::select('mcu_id')
                ->where('mcu_code', $row['mcu_code'])
                ->first();

            if ($modelMcu == null) {
                throw new \Exception('Terjadi Kesalahan! Peserta dengan kode mcu '.$row['mcu_code'].' Tidak Ditemukan!');
            }
            $mcu_id = $modelMcu->mcu_id;

            $doctor_id = null;
            if (!empty($row['doctor_code'])) {
                $modelDoctor = DoctorM::select('doctor_id')
                ->where('doctor_code', $row['doctor_code'])
                ->first();
                $doctor_id = $modelDoctor->doctor_id;
            }

            if ($modelDoctor == null) {
                throw new \Exception('Terjadi Kesalahan! Dokter dengan kode '.$row['doctor_code'].' Tidak Ditemukan!');
            }

            $modelAnamnesis = AnamnesisT::select('anamnesis_id')->where('mcu_id', $mcu_id)->first();
            if ($modelAnamnesis != null) {
                AnamnesisT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'anamnesis_code' => '-',
                'anamnesis_date' => date('Y-m-d H:i:s'),
                'systolic' => !empty($row['pemeriksaan_umum_sistol']) ? $row['pemeriksaan_umum_sistol'] : null,
                'diastolic' => !empty($row['pemeriksaan_umum_diastol']) ?  $row['pemeriksaan_umum_diastol'] : null,
                'pulse_rate' => !empty($row['pemeriksaan_umum_denyut_nadi']) ? $row['pemeriksaan_umum_denyut_nadi'] : null,
                'breathing' => !empty($row['pemeriksaan_umum_nafas']) ? $row['pemeriksaan_umum_nafas'] : null,
                'height' => !empty($row['pemeriksaan_umum_tinggi_badan']) ? $row['pemeriksaan_umum_tinggi_badan'] : null,
                'weight' => !empty($row['pemeriksaan_umum_berat_badan']) ? $row['pemeriksaan_umum_berat_badan'] : null,
                'bmi' => !empty($row['pemeriksaan_umum_bmi']) ? $row['pemeriksaan_umum_bmi'] : null,
                'weight_recommended' => !empty($row['pemeriksaan_umum_anjuran_berat_badan']) ? $row['pemeriksaan_umum_anjuran_berat_badan'] : null,
                'body_temprature' => !empty($row['pemeriksaan_umum_suhu_badan']) ? $row['pemeriksaan_umum_suhu_badan'] : null,
                'bmi_classification' => !empty($row['pemeriksaan_umum_kesan_bmi']) ? $row['pemeriksaan_umum_kesan_bmi'] : null,
                'skin_condition' => !empty($row['kulit_kondisi_kulit']) ? $row['kulit_kondisi_kulit'] : null,
                'medical_history' => json_encode($riwayatPenyakit),
                'habit_factor' => json_encode($faktorKebiasaan),
                'work_hazard_history' => json_encode($riwayatHazardLingkunganKerja),
                'eyes' => json_encode($fisikMata),
                'ears' => json_encode($fisikTelinga),
                'nose' => json_encode($fisikHidung),
                'oral_cavity' => json_encode($fisikRonggaMulut),
                'teeth' => json_encode($fisikGigi),
                'neck' => json_encode($fisikLeher),
                'thorax' => json_encode($fisikThorax),
                'abdomen' => json_encode($fisikAbdomen),
                'spine' => json_encode($fisikTulangBelakang),
                'upper_extremities' => json_encode($fisikEkstremitasAtas),
                'lower_extremities' => json_encode($fisikEkstremitasBawah),
                'notes' => !empty($row['catatan']) ? $row['catatan'] : null,
                'doctor_id' => !empty($row['doctor_code']) ? $doctor_id : null,
            ];
            AnamnesisT::insert($data);
        }
        DB::commit();
    }

    private function mappingMedicalHistory () {
        return [
            'id' => [
                'asma',
                'kencing_manis',
                'kejang_kejang_berulang',
                'penyakit_jantung',
                'batuk_dahak_darah',
                'rheumatik',
                'tekanan_darah_tinggi',
                'tekanan_darah_rendah',
                'sering_bengkak_wajah_kaki',
                'riwayat_operasi',
                'catatan_riwayat_operasi',
                'obat_terus_menerus',
                'alergi',
                'hepatitis',
                'kecanduan_obat_obatan',
                'patah_tulang',
                'gangguan_pendengaran',
                'perokok',
                'olahraga_rutin',
                'nyeri_buang_air_kecil',
                'keputihan',
                'epilepsi',
                'catatan_epilepsi',
                'keluhan_utama'
            ],
            'en' => [
                'asthma',
                'diabetes',
                'recurrent_seizures',
                'heart_disease',
                'haemoptysis',
                'rheumatism',
                'hypertension',
                'hypotension',
                'angioedema',
                'surgical_history',
                'surgical_history_notes',
                'drug_continously',
                'allergy',
                'hepatitis',
                'drug_addiction',
                'fracture',
                'hearing_disorders',
                'smoker',
                'exercise_regularly',
                'pain_when_urinating',
                'white_discharge',
                'epilepsy',
                'epilepsy_notes',
                'main_complaint'
            ]
        ];
    }

    private function mappingHabitFactor(){
        return [
            'id' => [
                'merokok',
                'olahraga',
                'alkohol',
                'alkohol_berapa_kali'
            ],
            'en' => [
                'smoking',
                'exercise',
                'alcohol',
                'alcohol_note'
            ]
        ];
    }

    private function mappingWorkHazardHistory(){
        return [
            'id' => [
                'bising',
                'bising_jam',
                'bising_tahun',
                'getaran',
                'getaran_jam',
                'getaran_tahun',
                'debu',
                'debu_jam',
                'debu_tahun',
                'zat_kimia',
                'zat_kimia_jam',
                'zat_kimia_tahun',
                'panas',
                'panas_jam',
                'panas_tahun',
                'asap',
                'asap_jam',
                'asap_tahun',
                'monitor_komputer',
                'monitor_komputer_jam',
                'monitor_komputer_tahun',
                'gerakan_berulang',
                'gerakan_berulang_jam',
                'gerakan_berulang_tahun',
                'mendorong_menarik',
                'mendorong_menarik_jam',
                'mendorong_menarik_tahun',
                'angkat_beban',
                'angkat_beban_jam',
                'angkat_beban_tahun'
            ],
            'en' => [
                'noise',
                'noise_hours',
                'noise_years',
                'vibration',
                'vibration_hours',
                'vibration_years',
                'dust',
                'dust_hours',
                'dust_years',
                'chemicals',
                'chemicals_hours',
                'chemicals_years',
                'heat',
                'heat_hours',
                'heat_years',
                'smoke',
                'smoke_hours',
                'smoke_years',
                'computer_monitor',
                'computer_monitor_hours',
                'computer_monitor_years',
                'repetitive_motion',
                'repetitive_motion_hours',
                'repetitive_motion_years',
                'push_pull',
                'push_pull_hours',
                'push_pull_years',
                'weightlifting',
                'weightlifting_hours',
                'weightlifting_years'
            ]
        ];
    }

    private function mappingEyes(){
        return [
            'id' => [
                'buta_warna',
                'kaca_mata',
                'visus_od',
                'visus_os',
                'visus',
                'strabismus_od',
                'strabismus_os',
                'strabismus',
                'anemis_konjungtiva',
                'sklera_ikterik',
                'reflek_pupil',
                'kelainan_kelenjar_mata',
                'catatan_kelainan_kelenjar_mata',
                'exohalmus',
                'lain_lain'
            ],
            'en' => [
                'color_blind',
                'eyeglasses',
                'visus_od',
                'visus_os',
                'visus',
                'strabismus_od',
                'strabismus_os',
                'strabismus',
                'anemic_conjunctiva',
                'icteric_sclera',
                'pupillary_reflex',
                'eye_gland_disorders',
                'eye_gland_disorders_notes',
                'exohalmus',
                'eyes_other'
            ]
        ];
    }

    private function mappingEars(){
        return [
            'id' => [
                'penurunan_kualitas_dengar',
                'kelainan_bentuk_telinga',
                'perforasi_membran_timpan',
                'lain_lain'
            ],
            'en' => [
                'hearing_loss',
                'ear_deformity',
                'tympanic_membrane_perforation',
                'ears_other'
            ]
        ];
    }

    private function mappingNose(){
        return [
            'id' => [
                'septum_deviasi',
                'sekret',
                'lain_lain'
            ],
            'en' => [
                'septal_deviation',
                'secret',
                'nose_other'
            ]
        ];
    }

    private function mappingOralCavity(){
        return [
            'id' => [
                'laboi_palatoschizis',
                'kelainan_faring',
                'pembesaran_tonsil',
                'lain_lain'
            ],
            'en' => [
                'laboi_palatoschizis',
                'pharyngeal_disorder',
                'tonsil_enlargement',
                'oral_cavity_other'
            ]
        ];
    }

    private function mappingTeeth(){
        return [
            'id' => [
                'carries_dentis',
                'gangren_radix',
                'gangren_pulpa',
                'calculus_dentis',
                'gigi_palsu',
                'lain_lain'
            ],
            'en' => [
                'carries_dentis',
                'gangren_radix',
                'gangren_pulpa',
                'calculus_dentis',
                'dentures',
                'teeth_other'
            ]
        ];
    }

    private function mappingNeck(){
        return [
            'id' => [
                'struma',
                'limfadenopati',
                'lain_lain'
            ],
            'en' => [
                'struma',
                'limfadenopati',
                'neck_other'
            ]
        ];
    }

    private function mappingThorax(){
        return [
            'id' => [
                'simetris',
                'kelainan_paru',
                'catatan_kelainan_paru',
                'kelainan_jantung',
                'catatan_kelainan_jantung',
                'lain_lain'
            ],
            'en' => [
                'symmetrical',
                'lung_disorder',
                'lung_disorder_notes',
                'heart_disorder',
                'heart_disorder_notes',
                'thorax_other'
            ]
        ];
    }

    private function mappingAbdomen(){
        return [
            'id' => [
                'kelainan_bentuk_abdomen',
                'bekas_operasi',
                'catatan_bekas_operasi',
                'hepatomegali',
                'splenomegali',
                'nyeri_tekan_epigastrium',
                'nyeri_tekan_titik_mcburney',
                'striae',
                'teraba_tumor',
                'lain_lain'
            ],
            'en' => [
                'abdominal_deformity',
                'surgical_scar',
                'surgical_scar_notes',
                'hepatomegaly',
                'splenomegaly',
                'epigastric_pain',
                'mcburney_point_tenderness',
                'striae',
                'palpable_tumor',
                'abdomen_other'
            ]
        ];
    }

    private function mappingSpine(){
        return [
            'id' => [
                'skoliosis_lordosis_kyposis',
                'lain_lain'
            ],
            'en' => [
                'scoliosis_lordosis_kyposis',
                'spine_other'
            ]
        ];
    }

    private function mappingUpperExtremities(){
        return [
            'id' => [
                'kelainan_bentuk_ekstremitas_atas',
                'hemiporasis_ekstremitas_atas',
                'pembengkakan_sendi_ekstremitas_atas',
                'lain_lain'
            ],
            'en' => [
                'upper_extremity_deformities',
                'upper_extremity_hemiparesis',
                'upper_extremity_joint_swelling',
                'upper_extremities_other'
            ]
        ];
    }

    private function mappingLowerExtremities(){
        return [
            'id' => [
                'kelainan_bentuk_ekstremitas_bawah',
                'varises',
                'polio',
                'hemiparesis_ekstremitas_bawah',
                'pembengkakan_sendi_ekstremitas_bawah',
                'lain_lain'
            ],
            'en' => [
                'lower_extremity_deformities',
                'varises',
                'polio',
                'lower_extremity_hemiparesis',
                'lower_extremity_joint_swelling',
                'lower_extremities_other'
            ]
        ];
    }

}
