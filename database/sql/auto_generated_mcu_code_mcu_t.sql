CREATE OR REPLACE FUNCTION generate_mcu_code()
RETURNS TRIGGER AS $$
DECLARE
    current_date_text TEXT;
    serial_number TEXT;
    max_code TEXT;
    today_code TEXT;
BEGIN
    -- Get today's date in the format YYYYMMDD
    current_date_text := TO_CHAR(CURRENT_DATE, 'YYYYMMDD');
    -- Extract the highest mcu_code for today's date
    SELECT MAX(mcu_code)
    INTO max_code
    FROM mcu_t
    WHERE mcu_code LIKE 'MCU' || current_date_text || '%';
    -- Generate the serial number
    IF max_code IS NULL THEN
        serial_number := '0001'; -- Start with 1 if no code exists for today
    ELSE
        serial_number := LPAD((CAST(SUBSTRING(max_code FROM 12 FOR 4) AS INTEGER) + 1)::TEXT, 4, '0');
    END IF;
    -- Concatenate to form the new mcu_code
    today_code := 'MCU' || current_date_text || serial_number;
    -- Assign the generated code to the new row
    NEW.mcu_code := today_code;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
