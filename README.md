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
FastRoute init time: 0.0058789253234863
TreeRoute init time: 0.0029020309448242
AlabasterRoute init time: 0.014953136444092

FastRoute first route time: 0.063666820526123
TreeRoute first route time: 0.060380220413208
AlabasterRoute first route time: 0.060018301010132

FastRoute middle route time: 0.143714427948
TreeRoute middle route time: 0.11122441291809
AlabasterRoute middle route time: 0.11234712600708

FastRoute last route time: 0.19296050071716
TreeRoute last route time: 0.10999894142151
AlabasterRoute last route time: 0.11317300796509

FastRoute not found time: 0.1564736366272
TreeRoute not found time: 0.051846742630005
AlabasterRoute not found time: 0.052735567092896
```
