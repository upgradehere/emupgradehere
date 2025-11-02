# Lab Results Inbox API (staging)

Minimal, secure endpoint for staging analyzer results into `public.lab_results_inbox_t`. **No auto-promotion.**

- **Route:** `POST /api/lab-results/inbox`
- **Auth:** `X-API-Key` (stored in DB table `api_keys`)
- **Throttle:** `labresults` = 60 req/min **per API key** (fallback to client IP if header missing)
- **DB trigger:** `trg_lrit_autoresolve` → `fn_lrit_autoresolve()` (fills `mcu_id`, `items_count`, `status`, `run_at`)
- **Promotion (manual):** `fn_promote_lab_inbox(mcu_id, source, user_id)`
- **Do not modify** DB trigger/functions above.

---

## Request & Response

**POST** `/api/lab-results/inbox`

**Headers**
- `Content-Type: application/json`
- `X-API-Key: <your-40+ char key>`

**Body (per patient)**
```json
{
  "source": "TC3060|TEK8520",
  "patient_id": "MCU...",            // used as mcu_code
  "generated_at": "2025-09-14T10:00:00",  // optional
  "obx": [
    { "test_name": "ALT", "value": "12", "unit": "U/L" },
    { "test_name": "GLU", "value": "92", "unit": "mg/dL" }
  ],
  "excel_file": "optional",
  "bridge_version": "optional"
}
