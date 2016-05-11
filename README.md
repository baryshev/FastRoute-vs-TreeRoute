FastRoute vs TreeRoute benchmark
================================

Installation
------------

```bash
git clone https://github.com/baryshev/FastRoute-vs-TreeRoute.git
cd FastRoute-vs-TreeRoute
composer install
```

Run benchmark
-------------

```bash
php ./benchmark.php
```

Results (MacBook Pro Core i5, php 5.6)
--------------------------------------

```
FastRoute init time: 0.0054872035980225
TreeRoute init time: 0.0027949810028076
AlabasterRoute init time: 0.015413045883179

FastRoute first route time: 0.056954145431519
TreeRoute first route time: 0.059270858764648
AlabasterRoute first route time: 0.059645891189575

FastRoute middle route time: 0.18004727363586
TreeRoute middle route time: 0.11252546310425
AlabasterRoute middle route time: 0.11031222343445

FastRoute last route time: 0.27443623542786
TreeRoute last route time: 0.1094024181366
AlabasterRoute last route time: 0.10798025131226

FastRoute not found time: 0.21182298660278
TreeRoute not found time: 0.05246376991272
AlabasterRoute not found time: 0.053146600723267
```
