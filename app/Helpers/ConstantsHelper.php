<?php

namespace App\Helpers;

class ConstantsHelper {

    // messages
    const MESSAGE_SUCCESS_SAVE = 'Data Berhasil Disimpan!';
    const MESSAGE_ERROR_SAVE = 'Terjadi Kesalahan. Data Gagal Disimpan!';
    const MESSAGE_SUCCESS_DELETE = 'Data Berhasil Dihapus!';
    const MESSAGE_ERROR_DELETE = 'Terjadi Kesalahan. Data Gagal Dihapus!';

    // lookup
    const LOOKUP_EXAMINATION_TYPE = 'examination_type';

    const LOOKUP_EXAMINATION_TYPE_ANAMNESIS = 20;
    const LOOKUP_EXAMINATION_TYPE_REFRACTION = 21;
    const LOOKUP_EXAMINATION_TYPE_LAB = 22;
    const LOOKUP_EXAMINATION_TYPE_RONTGEN = 23;
    const LOOKUP_EXAMINATION_TYPE_AUDIOMETRY = 24;
    const LOOKUP_EXAMINATION_TYPE_SPIROMETRY = 25;
    const LOOKUP_EXAMINATION_TYPE_EKG = 26;
    const LOOKUP_EXAMINATION_TYPE_USG = 27;
    const LOOKUP_EXAMINATION_TYPE_TREADMILL = 28;
    const LOOKUP_EXAMINATION_TYPE_PAPSMEAR = 29;
    const LOOKUP_EXAMINATION_TYPE_RESUME_MCU = 30;

}
