<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DataFetchController extends Controller
{
    /**
     * Fetch data from IGDB API using Python script.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */

     public function fetchData(Request $request)
     {
        // Validate input
        $request->validate([
            'endpoint' => 'required|string',
            'fields' => 'required|string',
        ]);

        $endpoint = $request->input('endpoint');
        $fields = $request->input('fields');

        // Define the path to the python script
        $script = base_path('scripts/fetch_data.py');

        // Create the process
        $process = new Process(['python'], $script, $endpoint, $fields);

        // Set the working directory to the project root
        $process->setWorkingDirectory(base_path());

        // Run the process
        $process->run();

        // Check if the process was successfull
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Get the output
        $output = $process->getOutput();


        return response()->json([
            'message' => 'Data fetch initiated successfully.',
            'output' => $output
        ]);

     }
}
