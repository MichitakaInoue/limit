<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ip = [
          ['id' => 1, 'name' => '本社', 'ip' => '127.0.0.1'],
          ['id' => 2, 'name' => '相手', 'ip' => '127.0.0.2'],
          ['id' => 3, 'name' => '元請け', 'ip' => '127.0.0.3']
        ];

        //$request->ip()でipアドレスを取得
        //コレクションインスタンスを生成する
        //containsでコレクションに特定のデータが含まれているかどうか
        $detect = collect($ip)->contains('ip', $request->ip());//真偽値で返ってくる
        // dd($detect);//true false
        // dd($request->ip());
        if($detect){
          //dd('ok');
        }

        if(!$detect){
          //routeにリダイレクト
          // dd('there is nothing ipAdress');
          return redirect('invalid');
        }

        //ipがアレばリクエストを通過
        return $next($request);
    }
}
