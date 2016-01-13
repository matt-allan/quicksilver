## Quicksilver

Quicksilver is a demo application to demonstrate hexagonal architecture concepts in PHP.  The app is for a bike messenger company to receive and track orders.

This was for a presentation I did at the LaravelSF meetup.  You can read the slides [here](https://docs.google.com/presentation/d/1kqcMqqmZbttgJcBCvmpXbzlTHVphcRCioshpx_bjc1w/edit?usp=sharing), but they might be a bit confusing without audio :)

### Implementations

The core is framework agnostic and just plain PHP.  It can be dropped in to any framework and wired up to an implementation.  Right now there is only a Laravel 5 implementation.

[Laravel 5](https://github.com/matthew-james/l5-quicksilver)

### Setup

```
composer install
```

### Run The Tests

The core ships with in memory implementations of the interfaces so that the app can be tested with Behat.

```
vendor/bin/behat
```
