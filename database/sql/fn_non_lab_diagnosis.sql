-- DROP FUNCTION public.fn_non_lab_diagnosis(int4);

CREATE OR REPLACE FUNCTION public.fn_non_lab_diagnosis(p_mcu_program_id integer)
 RETURNS TABLE(name text, count integer)
 LANGUAGE plpgsql
AS $function$
BEGIN
    RETURN QUERY
    SELECT 'bmi' AS name, COUNT(CASE WHEN bmi IS NOT NULL THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'tekanan_darah' AS name, COUNT(CASE WHEN (systolic > 139 AND diastolic > 89) OR (systolic < 90 AND diastolic < 60) THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'gigi' AS name, COUNT(CASE WHEN anamnesis_t.teeth::json->>'carries_dentis' = '1'
                                      OR anamnesis_t.teeth::json->>'gangren_radix' = '1'
                                      OR anamnesis_t.teeth::json->>'gangren_pulpa' = '1'
                                      OR anamnesis_t.teeth::json->>'calculus_dentis' = '1'
                                      OR anamnesis_t.teeth::json->>'dentures' = '1' THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'merokok' AS name, COUNT(CASE WHEN anamnesis_t.medical_history::json->>'smoker' = '1' THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'visus_mata' AS name, COUNT(CASE WHEN anamnesis_t.eyes::json->>'color_blind' = '1'
                                            OR anamnesis_t.eyes::json->>'visus' = '1'
                                            OR anamnesis_t.eyes::json->>'strabismus' = '1'
                                            OR anamnesis_t.eyes::json->>'anemic_conjunctiva' = '1'
                                            OR anamnesis_t.eyes::json->>'icteric_sclera' = '1'
                                            OR anamnesis_t.eyes::json->>'pupillary_reflex' = '0'
                                            OR anamnesis_t.eyes::json->>'eye_gland_disorders' = '1' THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN anamnesis_t ON anamnesis_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'rontgen' AS name, COUNT(CASE WHEN rontgen_t.is_abnormal IS NOT NULL THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN rontgen_t ON rontgen_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'audiometry' AS name, COUNT(CASE WHEN audiometry_t.is_abnormal IS NOT NULL THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN audiometry_t ON audiometry_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'spirometry' AS name, COUNT(CASE WHEN spirometry_t.is_abnormal IS NOT NULL THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN spirometry_t ON spirometry_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'ekg' AS name, COUNT(CASE WHEN ekg_t.is_abnormal IS NOT NULL THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN ekg_t ON ekg_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'usg' AS name, COUNT(CASE WHEN usg_t.is_abnormal IS NOT NULL THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN usg_t ON usg_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'treadmill' AS name, COUNT(CASE WHEN treadmill_t.is_abnormal IS NOT NULL THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN treadmill_t ON treadmill_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id
    UNION ALL
    SELECT 'papsmear' AS name, COUNT(CASE WHEN papsmear_t.is_abnormal IS NOT NULL THEN 1 END)::integer AS count
    FROM mcu_t
    LEFT JOIN papsmear_t ON papsmear_t.mcu_id = mcu_t.mcu_id
    WHERE mcu_t.mcu_program_id = p_mcu_program_id;
END;
$function$
;
