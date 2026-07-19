@component('mail::message')
# Welcome to GoRide, {{ $driverName }}! 🎉

Your application to become a GoRide driver has been **approved**! We're excited to have you join our driver community.

## Your Login Credentials

| Detail | Value |
|--------|-------|
| **Email** | `{{ $driverEmail }}` |
| **Temporary Password** | `{{ $temporaryPassword }}` |

## Next Steps

1. **Log in** to the GoRide Driver App using the credentials above
2. **Change your password** immediately after first login for security
3. **Complete your profile** in the driver app
4. **Go online** and start accepting ride requests!

@action('Log in to Driver Dashboard', $loginUrl)

## Important Notes

- **Keep your credentials secure** - Don't share your password with anyone
- **Change your password** on first login - This temporary password will expire
- **Verify your vehicle details** - Ensure your license plate and vehicle type are correct in the app
- **Complete your profile** - Add your profile photo and banking details for payouts

## Support

If you have any questions or need assistance:
- **Email:** support@goride.com
- **Phone:** +880 1XXX-XXXXXX
- **In-app:** Help & Support section in the driver app

Welcome aboard! The GoRide Team

@endcomponent