# Symfony Skeleton in a Domain Driven Design architecture
[![Latest Stable Version](https://poser.pugx.org/andythorne/symfony-skeleton-ddd/v)](//packagist.org/packages/andythorne/symfony-skeleton-ddd) [![Total Downloads](https://poser.pugx.org/andythorne/symfony-skeleton-ddd/downloads)](//packagist.org/packages/andythorne/symfony-skeleton-ddd) [![Latest Unstable Version](https://poser.pugx.org/andythorne/symfony-skeleton-ddd/v/unstable)](//packagist.org/packages/andythorne/symfony-skeleton-ddd) [![License](https://poser.pugx.org/andythorne/symfony-skeleton-ddd/license)](//packagist.org/packages/andythorne/symfony-skeleton-ddd) 

## Installation
```bash
composer create-project andythorne/symfony-skeleton-ddd
```

## Project Architecture
This project sets up symfony with separated application, domain and infrastructure layers:

| Path          | Namespace |
|---------------|-----------|
| `src/apps`    | `App\`    |
| `src/domains` | `Domain\` |
| `src/infra`   | `Infra\`  |

### Application Layer
Each application layer "app" has autoconfigured Controllers under `App\<AppName>\Controller\`. In-line with symfony
skeleton, you will need to set up routing for each app. It's suggested to set a path prefix for each app:

```yaml
# config/routes/annotations.yaml

# ACME app
acme_controllers:
    resource: '../../src/apps/Acme/Controller/**/*'
    type: annotation
    prefix: /acme
```

App-level service configuration should be done in `config/apps/<appName>.yaml`.

### Domain Layer
Each domain under `Domain\` has the symfony event dispatcher autoconfigured by default.

Domain-level service configuration should be done in `config/domains/<domainName>.yaml`.

### Infra Layer
Infra-level service configuration should be done in `config/infra/<infraName>.yaml`.
