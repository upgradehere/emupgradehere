-- public.mcu_company_v source

CREATE OR REPLACE VIEW public.mcu_company_v
AS SELECT mp.mcu_program_id,
    mp.mcu_program_code,
    mp.mcu_program_name,
    company_m.company_id,
    company_m.company_code,
    company_m.company_name,
    count(mcu_t.mcu_program_id) AS mcu_sum
   FROM mcu_program_m mp
     LEFT JOIN company_m ON company_m.company_id = mp.company_id
     LEFT JOIN mcu_t ON mcu_t.mcu_program_id = mp.mcu_program_id AND mcu_t.company_id = company_m.company_id
  WHERE mcu_t.deleted_at IS NULL AND mp.deleted_at IS NULL AND company_m.deleted_at IS NULL
  GROUP BY mp.mcu_program_id, mp.mcu_program_code, mp.mcu_program_name, company_m.company_id, company_m.company_code, company_m.company_name;
