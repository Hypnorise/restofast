<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransformApiResponse
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
//		return $next($request);

		$response = $next($request);
		// Transform keys of successful JSON responses to camelCase
		if ($response->isSuccessful() && $response->headers->get('Content-Type') === 'application/json') {
			$data = json_decode($response->getContent(), true);
			if ($data) {
				$transformedData = $this->transform($data);
				$response->setContent(json_encode($transformedData));
			}
		}

		return $response;
	}

	/**
	 *
	 *
	 * @param array $data
	 * @return array
	 */
	private function transform($data)
	{
		$result = ['data' => null, 'metadata' => null];
		$coll = collect($data);
		if ($coll->has('data')) {
			$result['metadata'] = $coll->except('data');
			$result['data'] = collect($data['data'])->keyBy('id');
			return $result;
		}
		if ($coll->has('id'))
			$result['data'] = $coll->all();
		else
			$result['data'] = $coll->keyBy('id')->all();

		return $result;
	}
}
