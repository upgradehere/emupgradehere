-- public.mcu_employee_v source

CREATE OR REPLACE VIEW public.mcu_employee_v
AS SELECT mcu_t.mcu_id,
    mcu_t.mcu_code,
    mcu_t.mcu_date,
    mcu_t.employee_id,
    employee_m.employee_code,
    employee_m.employee_name,
    departement_m.departement_id,
    departement_m.departement_code,
    departement_m.departement_name,
    company_m.company_id,
    mcu_program_m.mcu_program_id,
    lookup_c.lookup_name AS sex,
    employee_m.dob,
    date_part('year'::text, age(employee_m.dob)) || ' Tahun'::text AS age,
    mcu_t.additional_data,
    employee_m.nik,
    package_m.id AS package_id,
    package_m.package_code,
    package_m.package_name,
    mcu_t.deleted_at
   FROM mcu_t
     LEFT JOIN employee_m ON employee_m.employee_id = mcu_t.employee_id
     LEFT JOIN departement_m ON departement_m.departement_id = employee_m.departement_id
     LEFT JOIN company_m ON company_m.company_id = mcu_t.company_id
     LEFT JOIN mcu_program_m ON mcu_program_m.mcu_program_id = mcu_t.mcu_program_id
     LEFT JOIN lookup_c ON employee_m.sex = lookup_c.lookup_id
     LEFT JOIN package_m ON package_m.id = mcu_t.package_id
  GROUP BY mcu_t.mcu_id, mcu_t.mcu_code, mcu_t.mcu_date, mcu_t.employee_id, employee_m.employee_code, employee_m.employee_name, departement_m.departement_id, departement_m.departement_code, departement_m.departement_name, company_m.company_id, mcu_program_m.mcu_program_id, lookup_c.lookup_name, employee_m.dob, mcu_t.additional_data, employee_m.nik, package_m.id, package_m.package_code, package_m.package_name;
