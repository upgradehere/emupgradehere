-- DROP FUNCTION public.fn_sindrom_metabolik(int4);

CREATE OR REPLACE FUNCTION public.fn_sindrom_metabolik(p_mcu_program_id integer)
 RETURNS TABLE(name text, count_abnormal integer, count_normal integer)
 LANGUAGE plpgsql
AS $function$
BEGIN
    RETURN QUERY
    -- BMI
    SELECT
        'bmi' AS name,
        COUNT(CASE WHEN bmi < 23 OR bmi > 24.9 THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN bmi >= 23 AND bmi <= 24.9 THEN 1 END)::integer AS count_normal
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    -- Tekanan Darah
    SELECT
        'tekanan_darah' AS name,
        COUNT(CASE WHEN (systolic > 139 AND diastolic > 89) OR (systolic < 90 AND diastolic < 60) THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN (systolic <= 139 AND diastolic <= 89) OR (systolic >= 90 AND diastolic >= 60) THEN 1 END)::integer AS count_normal
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    -- Kolesterol
    SELECT
        'kolesterol' AS name,
        COUNT(CASE WHEN laboratory_examination_id = 46 AND CAST(laboratory_detail_t.result AS NUMERIC) > 199 THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN laboratory_examination_id = 46 AND CAST(laboratory_detail_t.result AS NUMERIC) <= 199 THEN 1 END)::integer AS count_normal
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
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
        )::integer AS count_normal
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    -- Glukosa Sewaktu
    SELECT
        'glukosa_sewaktu' AS name,
        COUNT(CASE WHEN laboratory_examination_id = 50 AND CAST(laboratory_detail_t.result AS NUMERIC) > 199 THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN laboratory_examination_id = 50 AND CAST(laboratory_detail_t.result AS NUMERIC) <= 199 THEN 1 END)::integer AS count_normal
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    -- Glukosa Puasa
    SELECT
        'glukosa_puasa' AS name,
        COUNT(CASE WHEN laboratory_examination_id = 51 AND CAST(laboratory_detail_t.result AS NUMERIC) > 125 THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN laboratory_examination_id = 51 AND CAST(laboratory_detail_t.result AS NUMERIC) <= 125 THEN 1 END)::integer AS count_normal
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    -- Rontgen
    SELECT
        'rontgen' AS name,
        COUNT(CASE WHEN rontgen_t.is_abnormal THEN 1 END)::integer AS count_abnormal,
        COUNT(CASE WHEN rontgen_t.is_abnormal IS NOT TRUE THEN 1 END)::integer AS count_normal
    FROM mcu_t
    LEFT JOIN rontgen_t ON rontgen_t.mcu_id = mcu_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id;

END;
$function$
;
