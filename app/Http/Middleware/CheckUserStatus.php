<?php

namespace App\Http\Middleware;

use App\Enums\Enums\Status;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินอยู่ และสถานะเป็น inactive
        if (Auth::check() && Auth::user()->status === Status::INACTIVE) {

            // ทำการล็อกเอาต์ผู้ใช้
            Auth::logout();

            // ล้างข้อมูล session ทั้งหมดและสร้าง token ใหม่
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // ส่งกลับไปหน้า login พร้อมข้อความแจ้งเตือน
            return redirect()->route('login')
                ->with('error', 'บัญชีของคุณถูกระงับการใช้งาน กรุณาติดต่อผู้ดูแลระบบ');
        }
        return $next($request);
    }
}
