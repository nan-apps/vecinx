<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DeployController extends Controller
{
	public function deploy(Request $request)
	{
		$githubPayload = $request->getContent();
		$githubHash = $request->header('X-Hub-Signature');
		$localToken = config('app.deploy_secret');
		$localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
		if (hash_equals($githubHash, $localHash)) {
			echo "sha ok!"
			$root_path = base_path();
			$process = new Process(["cd {$root_path}", './deploy.sh']);
			echo $process->isSuccessful() ? "Exito!" : "Algo salió mal";
			echo $process->getOutput();
		}
	}
}
