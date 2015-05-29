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

``
FastRoute init time: 0.0056021213531494
TreeRoute init time: 0.0034558773040771
FastRoute first route time: 0.040349006652832
TreeRoute first route time: 0.038413763046265
FastRoute middle route time: 0.16081953048706
TreeRoute middle route time: 0.076460361480713
FastRoute last route time: 0.25658130645752
TreeRoute last route time: 0.076943397521973
FastRoute not found time: 0.2103226184845
TreeRoute not found time: 0.034482717514038
``