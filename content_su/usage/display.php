<?php
$dat = getrusage();
echo @$dat["ru_oublock"];       // number of block output operations
echo @$dat["ru_inblock"];       // number of block input operations
echo @$dat["ru_msgsnd"];        // number of IPC messages sent
echo @$dat["ru_msgrcv"];        // number of IPC messages received
echo @$dat["ru_maxrss"];        // maximum resident set size
echo @$dat["ru_ixrss"];         // integral shared memory size
echo @$dat["ru_idrss"];         // integral unshared data size
echo @$dat["ru_minflt"];        // number of page reclaims (soft page faults)
echo @$dat["ru_majflt"];        // number of page faults (hard page faults)
echo @$dat["ru_nsignals"];      // number of signals received
echo @$dat["ru_nvcsw"];         // number of voluntary context switches
echo @$dat["ru_nivcsw"];        // number of involuntary context switches
echo @$dat["ru_nswap"];         // number of swaps
echo @$dat["ru_utime.tv_usec"]; // user time used (microseconds)
echo @$dat["ru_utime.tv_sec"];  // user time used (seconds)
echo @$dat["ru_stime.tv_usec"]; // system time used (microseconds)

echo "<pre class='box pA20'>";
var_dump($dat);
echo "</pre>";
?>
