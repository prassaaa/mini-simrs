import KunjunganController from '@/actions/App/Http/Controllers/KunjunganController';
import MasterDokterController from '@/actions/App/Http/Controllers/MasterDokterController';
import MasterPenjaminController from '@/actions/App/Http/Controllers/MasterPenjaminController';
import MasterPoliController from '@/actions/App/Http/Controllers/MasterPoliController';
import PasienController from '@/actions/App/Http/Controllers/PasienController';
import TransaksiController from '@/actions/App/Http/Controllers/TransaksiController';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { Calendar, LayoutGrid, Stethoscope, Building2, CreditCard, Users, Receipt } from 'lucide-react';
import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Pasien',
        href: PasienController.index(),
        icon: Users,
    },
    {
        title: 'Kunjungan',
        href: KunjunganController.index(),
        icon: Calendar,
    },
    {
        title: 'Transaksi',
        href: TransaksiController.index(),
        icon: Receipt,
    },
    {
        title: 'Master Dokter',
        href: MasterDokterController.index(),
        icon: Stethoscope,
    },
    {
        title: 'Master Poli',
        href: MasterPoliController.index(),
        icon: Building2,
    },
    {
        title: 'Master Penjamin',
        href: MasterPenjaminController.index(),
        icon: CreditCard,
    },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboard()} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
