Muse
====

Test project for the new `MicroKernelTrait` that will be in Symfony 2.8.

Getting Started
---------------

In order to create a new Project, you need to create a new "Kernel" or "Application" that
uses the `Kernel` provided with Muse.

The implementation must as a minimum implement the `registerBundles` method and register
`FrameworkBundle`.

``` php
<?php

class MyKernel extends \Muse\Kernel
{
    public function registerBundles()
    {
        return [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
    }
}
```

By convention we assume the root directory is one level up from the location of your
implementation. This means that we usually would have the implementation in a 
`src/MyKernel.php` file.

From the root directory we also do some convenient auto setup of cache and logs directories
that are specific to each environment. You can find the generated cache and log files here:

```
%kernel.root_dir%/{logs,cache}/%kernel.environment%
```

Configuration files are also loaded based on convention and the environment. Configuration
is loaded from:

```
%kernel.root_dir%/config/%kernel.environment%.yml
```

We use YAML as there isn't any support for JSON when loading for the DependencyInjection
component.

For more information read about the new `MicroKernelTrait` that can be found in `FrameworkBundle`.


Benchmarks
----------

Because why not? These are VERY simple and shouldn't be taken seriously.

```
Muse\Benchmarks\KernelBenchmark
    Method Name   Iterations    Average Time      Ops/second
    --------  ------------  --------------    -------------
    homepage: [10,000    ] [0.0002397856474] [4,170.39139]
```

and for fun here is the same for Symfony Standard (not that it uses more bundles etc.)

```
Benchmarks\AppKernelBenchmark
    Method Name   Iterations    Average Time      Ops/second
    --------  ------------  --------------    -------------
    homepage: [10,000    ] [0.0005079732418] [1,968.60763]
```
