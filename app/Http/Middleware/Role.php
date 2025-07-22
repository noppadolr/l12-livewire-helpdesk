<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Enums\Role;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles): Response
    {

        // ตรวจสอบว่าล็อกอินหรือยัง ถ้ายังให้ไปหน้า login
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $user = Auth::user();

        // ตรวจสอบว่า Role ของผู้ใช้ อยู่ในรายการ Role ที่ได้รับอนุญาตหรือไม่
        // เราใช้ $user->role->value เพื่อดึงค่า string ('admin', 'manager', 'user') จาก Enum
        if (!in_array($user->role->value, $roles)) {
            // ถ้า Role ไม่ตรง ให้ redirect กลับไปหน้าก่อนหน้าพร้อมข้อความ error
//            return redirect()->back()->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้ (Access Denied)');
            return redirect(URL::previous())->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้ (Access Denied)');
        }

        // หากมีสิทธิ์ถูกต้อง ให้ดำเนินการต่อไป
        return $next($request);
    }
}
