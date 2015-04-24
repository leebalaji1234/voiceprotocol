#!/usr/bin/php -q
<?php
global $pids;
$pids = Array();
$pid = pcntl_fork();
if ($pid) {
    exit();
}

pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGHUP, "sig_handler");
pcntl_signal(SIGINT, "sig_handler");
pcntl_signal(SIGUSR1, "sig_handler");

$program = "worker.php";
$arguments = Array("");

while (TRUE) {
    if (count($pids) < 6) {
        $pid = pcntl_fork();
        if (!$pid) {
            pcntl_exec($program, $arguments);
            exit();
        } else {
            $pids[] = $pid;
        }
    }
    $dead_and_gone = pcntl_waitpid(-1, $status, WNOHANG);
    while ($dead_and_gone > 0) {
        unset($pids[array_search($dead_and_gone, $pids)]);
        $dead_and_gone = pcntl_waitpid(-1, $status, WNOHANG);
    }
    sleep(1);
}

function sig_handler($signo) {
    global $pids, $pidFileWritten;
    if ($signo == SIGTERM || $signo == SIGHUP || $signo == SIGINT) {
        foreach ($pids as $p) {
            posix_kill($p, $signo);
        }
        foreach ($pids as $p) {
            pcntl_waitpid($p, $status);
        }
        exit();
    } else if ($signo == SIGUSR1) {
    }
}