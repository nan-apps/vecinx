<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DeployController extends Controller
{
	public function deploy(Request $request)
	{
		putenv('PATH=/usr/local/bin');
		$githubPayload = $request->getContent();
		$githubHash = $request->header('X-Hub-Signature');
		$localToken = config('app.deploy_secret');
		$localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
		if (hash_equals($githubHash, $localHash)) {
			echo "sha ok!\n";
			$root_path = base_path();
			$process = new Process(['cd ' . $root_path . '; ./deploy.sh']);
			$process->run();
			if($process->isSuccessful()){
				echo "¡Éxito!\n";
				echo $process->getOutput();
			} else {
				echo "Algo salió mal!\n";
				echo $process->getErrorOutput();
			}
		}
	}
}
