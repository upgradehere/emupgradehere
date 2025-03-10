-- DROP FUNCTION public.fn_sindrom_metabolik(int4);

CREATE OR REPLACE FUNCTION public.fn_sindrom_metabolik(p_mcu_program_id integer)
 RETURNS TABLE(name text, count_abnormal integer, count_normal integer, json_data json, count_all integer)
 LANGUAGE plpgsql
AS $function$
BEGIN
    RETURN QUERY
--     BMI
    SELECT
        'bmi' AS name,
        COUNT(CASE WHEN bmi < 23 OR bmi > 24.9 THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN bmi >= 23 AND bmi <= 24.9 THEN 1 END)::integer AS count_normal,
        json_build_object(
            'berat_badan_kurang', COUNT(CASE WHEN bmi < 18.5 THEN 1 END)::integer,
            'normal', COUNT(CASE WHEN bmi >= 18.5 and bmi <= 22.9 THEN 1 END)::integer,
            'overweight', COUNT(CASE WHEN bmi >= 23 and bmi <= 24.9 THEN 1 END)::integer,
            'obesitas_tingkat_1', COUNT(CASE WHEN bmi >= 25 and bmi <= 29.9 THEN 1 END)::integer,
            'obesitas_tingkat_2', COUNT(CASE WHEN bmi >= 30 THEN 1 END)::integer
        ) AS json_data,
		count(bmi)::integer as count_all
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
	and mcu_t.deleted_at is null
    and anamnesis_t.deleted_at is null
    UNION all
    -- Tekanan Darah
    SELECT
        'tekanan_darah' AS name,
        COUNT(CASE WHEN (systolic >= 130 AND systolic <= 139 OR diastolic >= 80 AND diastolic <= 89) THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN (systolic < 120 AND diastolic < 80) THEN 1 END)::integer AS count_normal,
        json_build_object(
            'normal', COUNT(CASE WHEN (systolic < 120 AND diastolic < 80) THEN 1 END)::integer,
            'elevasi', COUNT(CASE WHEN (systolic >= 120 AND systolic <= 129 AND diastolic < 80) THEN 1 END)::integer,
            'hipertensi_derajat_1', COUNT(CASE WHEN (systolic >= 130 AND systolic <= 139 OR diastolic >= 80 AND diastolic <= 89) THEN 1 END)::integer,
            'hipertensi_derajat_2', COUNT(CASE WHEN (systolic >= 140 AND systolic <= 179 OR diastolic >= 90 AND diastolic <= 119) THEN 1 END)::integer,
            'krisis_hipertensi', COUNT(CASE WHEN (systolic >= 180 OR diastolic >= 120) THEN 1 END)::integer
        ) AS json_data,
        count(systolic)::integer as count_all
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
	and mcu_t.deleted_at is null
    and anamnesis_t.deleted_at is null
    UNION all
    -- Kolesterol
    SELECT
        'kolesterol' AS name,
        COUNT(CASE WHEN laboratory_examination_id = 46 AND CAST(laboratory_detail_t.result AS NUMERIC) > 199 THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN laboratory_examination_id = 46 AND CAST(laboratory_detail_t.result AS NUMERIC) <= 199 THEN 1 END)::integer AS count_normal,
        json_build_object(
            'normal', COUNT(CASE WHEN laboratory_examination_id = 46 AND CAST(laboratory_detail_t.result AS NUMERIC) <= 199 THEN 1 END)::integer,
            'batas_tinggi', COUNT(CASE WHEN laboratory_examination_id = 46 AND (CAST(laboratory_detail_t.result AS NUMERIC) >= 200 and CAST(laboratory_detail_t.result AS NUMERIC) <= 239) THEN 1 END)::integer,
            'tinggi', COUNT(CASE WHEN laboratory_examination_id = 46 AND CAST(laboratory_detail_t.result AS NUMERIC) >= 240 THEN 1 END)::integer
        ) AS json_data,
        COUNT(CASE WHEN laboratory_examination_id = 46 then 1 end)::integer as count_all
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
	and mcu_t.deleted_at is null
	and laboratory_t.deleted_at is null
    and laboratory_detail_t.deleted_at is null
    UNION ALL
    -- Asam Urat
    SELECT
        'asam_urat' AS name,
        COUNT(
            CASE WHEN laboratory_examination_id = 56
                AND (
                    (CAST(laboratory_detail_t.result AS NUMERIC) > 7.0 AND employee_m.sex = 11) OR
                    (CAST(laboratory_detail_t.result AS NUMERIC) > 6.0 AND employee_m.sex = 12)
                ) THEN 1 END
        )::integer AS count_abnormal,
        COUNT(
            CASE WHEN laboratory_examination_id = 56
                AND (
                    (CAST(laboratory_detail_t.result AS NUMERIC) <= 7.0 AND employee_m.sex = 11) OR
                    (CAST(laboratory_detail_t.result AS NUMERIC) <= 6.0 AND employee_m.sex = 12)
                ) THEN 1 END
        )::integer AS count_normal,
        json_build_object(
            'tinggi', COUNT(
                CASE WHEN laboratory_examination_id = 56
                    AND (
                        (CAST(laboratory_detail_t.result AS NUMERIC) > 7.0 AND employee_m.sex = 11) OR
                        (CAST(laboratory_detail_t.result AS NUMERIC) > 6.0 AND employee_m.sex = 12)
                    ) THEN 1 END
            )::integer,
            'normal', COUNT(
                CASE WHEN laboratory_examination_id = 56
                    AND (
                        (CAST(laboratory_detail_t.result AS NUMERIC) <= 7.0 AND employee_m.sex = 11) OR
                        (CAST(laboratory_detail_t.result AS NUMERIC) <= 6.0 AND employee_m.sex = 12)
                    ) THEN 1 END
            )::integer
        ) AS json_data,
        COUNT(CASE WHEN laboratory_examination_id = 56 then 1 end)::integer as count_all
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
	and mcu_t.deleted_at is null
	and laboratory_t.deleted_at is null
    and laboratory_detail_t.deleted_at is null
    UNION all
    -- Glukosa Sewaktu
    SELECT
        'glukosa_sewaktu' AS name,
        COUNT(CASE WHEN laboratory_examination_id = 50 AND CAST(laboratory_detail_t.result AS NUMERIC) > 199 THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN laboratory_examination_id = 50 AND CAST(laboratory_detail_t.result AS NUMERIC) < 140 THEN 1 END)::integer AS count_normal,
        json_build_object(
            'normal', COUNT(CASE WHEN laboratory_examination_id = 50 AND CAST(laboratory_detail_t.result AS NUMERIC) < 140 THEN 1 END)::integer,
            'prediabetes', COUNT(CASE WHEN laboratory_examination_id = 50 AND (CAST(laboratory_detail_t.result AS NUMERIC) >= 140 and CAST(laboratory_detail_t.result AS NUMERIC) <= 199) THEN 1 END)::integer,
            'diabetes', COUNT(CASE WHEN laboratory_examination_id = 50 AND CAST(laboratory_detail_t.result AS NUMERIC) >= 200 THEN 1 END)::integer
        ) AS json_data,
        COUNT(CASE WHEN laboratory_examination_id = 50 then 1 end)::integer as count_all
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
	and mcu_t.deleted_at is null
	and laboratory_t.deleted_at is null
    and laboratory_detail_t.deleted_at is null
    UNION all
    -- Glukosa Puasa
    SELECT
        'glukosa_puasa' AS name,
        COUNT(CASE WHEN laboratory_examination_id = 51 AND CAST(laboratory_detail_t.result AS NUMERIC) >= 126 THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN laboratory_examination_id = 51 AND CAST(laboratory_detail_t.result AS NUMERIC) < 100 THEN 1 END)::integer AS count_normal,
        json_build_object(
            'normal', COUNT(CASE WHEN laboratory_examination_id = 51 AND CAST(laboratory_detail_t.result AS NUMERIC) < 100 THEN 1 END)::integer,
            'prediabetes', COUNT(CASE WHEN laboratory_examination_id = 51 AND (CAST(laboratory_detail_t.result AS NUMERIC) >= 100 and CAST(laboratory_detail_t.result AS NUMERIC) <= 125) THEN 1 END)::integer,
            'diabetes', COUNT(CASE WHEN laboratory_examination_id = 51 AND CAST(laboratory_detail_t.result AS NUMERIC) >= 126 THEN 1 END)::integer
        ) AS json_data,
        COUNT(CASE WHEN laboratory_examination_id = 51 then 1 end)::integer as count_all
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
	and laboratory_t.deleted_at is null
    and laboratory_detail_t.deleted_at is null;
END;
$function$
;
