# Laratickets Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aichadigital/laratickets-filament.svg?style=flat-square)](https://packagist.org/packages/aichadigital/laratickets-filament)
[![Total Downloads](https://img.shields.io/packagist/dt/aichadigital/laratickets-filament.svg?style=flat-square)](https://packagist.org/packages/aichadigital/laratickets-filament)

> **Warning**
> This package is under active development and is NOT ready for production use.
> API and features may change without notice.

---

Filament admin panel resources for [Laratickets](https://github.com/AichaDigital/laratickets) - Support ticket system.

## Requirements

- PHP 8.4+
- Laravel 11.x / 12.x
- Filament 4.x
- [aichadigital/laratickets](https://github.com/AichaDigital/laratickets) ^0.1

## Installation

```bash
composer require aichadigital/laratickets-filament
```

## Resources Included

This package provides Filament Resources for:

- **TicketResource** - Manage support tickets
- **DepartmentResource** - Configure support departments
- **AgentResource** - Manage support agents
- **PriorityResource** - Configure ticket priorities

## Features

- Full ticket lifecycle management
- Agent assignment and escalation
- Customer satisfaction ratings
- Department-based routing
- Risk assessment tools

## Usage

Resources are automatically registered with your Filament panel.

## Related Packages

| Package | Description |
|---------|-------------|
| [laratickets](https://github.com/AichaDigital/laratickets) | Core ticket backend |

## Testing

```bash
composer test
```

## Credits

- [Abdelkarim Mateos Sanchez](https://github.com/abkrim)
- [All Contributors](../../contributors)

## License

MIT License. See [LICENSE](LICENSE.md) for details.
