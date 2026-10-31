import { Link ,usePage } from '@inertiajs/react';
import { BookOpen, Building2, FolderGit2, LayoutGrid ,Briefcase, User} from 'lucide-react';
import AppLogo from '@/components/app-logo';
import { NavFooter } from '@/components/nav-footer';
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
import type { Auth, NavItem } from '@/types';
type Role = Auth['user']['role'];

// Each item lists the roles allowed to see it. Undefined means "everyone".
type GatedNavItem = NavItem & { roles?: Role[] };



const mainNavItems: GatedNavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
      {
        title: 'Departments',
        href: '/departments',
        icon: Building2,
        roles: ['admin', 'hr'],
    },
    {
        title: 'Positions',
        href: '/positions',
        icon: Briefcase,
        roles: ['admin', 'hr'],
    },
    {
        title: 'Employees',
        href: '/employees',
        icon: User,
        roles: ['admin', 'hr', 'manager'],
    },

    {
        title: 'Leave Requests',
        href: '/leave-requests',
        icon: BookOpen,
        roles: ['admin', 'hr', 'manager'],
    },
];

// const footerNavItems: GatedNavItem[] = [
//     {
//         title: 'Repository',
//         href: 'https://github.com/laravel/react-starter-kit',
//         icon: FolderGit2,
//     },
//     {
//         title: 'Documentation',
//         href: 'https://laravel.com/docs/starter-kits#react',
//         icon: BookOpen,
//     },
// ];

export function AppSidebar() {
     const { auth } = usePage().props;
    const role = auth.user?.role;

    const visibleItems = mainNavItems.filter(
        (item) => !item.roles || (role && item.roles.includes(role)),
    );

    // ...
    <NavMain items={visibleItems} />
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
                <NavMain items={visibleItems    } />
            </SidebarContent>

            <SidebarFooter>
                {/* <NavFooter items={footerNavItems} className="mt-auto" /> */}
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
