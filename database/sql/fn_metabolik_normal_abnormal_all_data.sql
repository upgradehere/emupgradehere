-- DROP FUNCTION public.fn_metabolik_normal_abnormal_all_data(int4);

CREATE OR REPLACE FUNCTION public.fn_metabolik_normal_abnormal_all_data(mcu_program_idx integer)
 RETURNS TABLE(employee_id integer, mcu_id integer, total_abnormal_examinations integer)
 LANGUAGE sql
 STABLE
AS $function$
WITH examination_results AS (
    -- BMI
    SELECT
        mcu_t.mcu_id,
        employee_m.employee_id,
        COUNT(CASE WHEN bmi < 23 OR bmi > 24.9 THEN 1 END) AS bmi_abnormal,
        0 AS tekanan_darah_abnormal,
        0 AS kolesterol_abnormal,
        0 AS asam_urat_abnormal
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id AND anamnesis_t.deleted_at IS NULL
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = mcu_program_idx
	AND mcu_t.deleted_at IS NULL
    GROUP BY mcu_t.mcu_id, employee_m.employee_id
    UNION ALL
    -- Blood Pressure
    SELECT
        mcu_t.mcu_id,
        employee_m.employee_id,
        0 AS bmi_abnormal,
        COUNT(CASE WHEN systolic BETWEEN 130 AND 139 OR diastolic BETWEEN 80 AND 89 THEN 1 END) AS tekanan_darah_abnormal,
        0 AS kolesterol_abnormal,
        0 AS asam_urat_abnormal
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id AND anamnesis_t.deleted_at IS NULL
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = mcu_program_idx
	AND mcu_t.deleted_at IS NULL
    GROUP BY mcu_t.mcu_id, employee_m.employee_id
    UNION ALL
    -- Cholesterol
    SELECT
        mcu_t.mcu_id,
        employee_m.employee_id,
        0 AS bmi_abnormal,
        0 AS tekanan_darah_abnormal,
        COUNT(CASE WHEN laboratory_examination_id = 46 AND CAST(laboratory_detail_t.result AS NUMERIC) > 199 THEN 1 END) AS kolesterol_abnormal,
        0 AS asam_urat_abnormal
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = mcu_program_idx
	AND mcu_t.deleted_at IS NULL
    AND laboratory_detail_t.deleted_at IS NULL
    GROUP BY mcu_t.mcu_id, employee_m.employee_id
    UNION ALL
    -- Uric Acid
    SELECT
        mcu_t.mcu_id,
        employee_m.employee_id,
        0 AS bmi_abnormal,
        0 AS tekanan_darah_abnormal,
        0 AS kolesterol_abnormal,
        COUNT(
            CASE WHEN laboratory_examination_id = 56 AND (
                (CAST(laboratory_detail_t.result AS NUMERIC) > 7.0 AND employee_m.sex = 11) OR
                (CAST(laboratory_detail_t.result AS NUMERIC) > 6.0 AND employee_m.sex = 12)
            ) THEN 1 END
        ) AS asam_urat_abnormal
    FROM laboratory_detail_t
    LEFT JOIN laboratory_t ON laboratory_t.laboratory_id = laboratory_detail_t.laboratory_id
    LEFT JOIN mcu_t ON mcu_t.mcu_id = laboratory_t.mcu_id
    LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
    WHERE mcu_t.mcu_program_id = mcu_program_idx
	AND mcu_t.deleted_at IS NULL
    AND laboratory_detail_t.deleted_at IS NULL
    GROUP BY mcu_t.mcu_id, employee_m.employee_id
),
summary AS (
    SELECT
        employee_id,
        mcu_id,
        SUM(bmi_abnormal) AS bmi_abnormal,
        SUM(tekanan_darah_abnormal) AS tekanan_darah_abnormal,
        SUM(kolesterol_abnormal) AS kolesterol_abnormal,
        SUM(asam_urat_abnormal) AS asam_urat_abnormal
    FROM examination_results
    GROUP BY employee_id, mcu_id
),
final_summary AS (
    SELECT
        employee_id,
        mcu_id,
        (bmi_abnormal + tekanan_darah_abnormal + kolesterol_abnormal + asam_urat_abnormal) AS total_abnormal_examinations
    FROM summary
)
select
	employee_id,
	mcu_id,
	total_abnormal_examinations::integer AS total_abnormal_examinations
FROM final_summary;
$function$
;
