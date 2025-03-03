<?php 
namespace Contracts\Middleware;

interface Contract
{
    /**
     * @param mixed $request
     * @param mixed $next
     * 
     * @return mixed
     */
    public function handle($request , $next , ...$role);
}