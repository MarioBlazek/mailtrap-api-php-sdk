# Documentation


### Integration with Symfony

To register the Mailtrap services inside Symfony's service container, add this to the `service.yaml` file:

```yaml
parameters:
    mailtrap_api_token: '%env(MAILTRAP_API_TOKEN)%'

services:
    Marek\Mailtrap\API\InboxService:
        factory: ['Marek\Mailtrap\Core\Factory\InboxServiceFactory', 'create']
        arguments: ['%mailtrap_api_token%']

    Marek\Mailtrap\API\ProjectService:
        factory: ['Marek\Mailtrap\Core\Factory\ProjectServiceFactory', 'create']
        arguments: ['%mailtrap_api_token%']
```
