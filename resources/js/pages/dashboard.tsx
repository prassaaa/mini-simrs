import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { Users, Stethoscope, Calendar, Receipt, TrendingUp, Activity } from 'lucide-react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { format } from 'date-fns';
import { id } from 'date-fns/locale';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

interface Stats {
    totalPasien: number;
    totalDokter: number;
    totalKunjungan: number;
    totalTransaksi: number;
    kunjunganHariIni: number;
    totalPendapatan: number;
}

interface Kunjungan {
    id: number;
    no_registrasi_kunjungan: string;
    tanggal_kunjungan: string;
    instalasi: string;
    pasien: {
        nama_pasien: string;
        no_rm: string;
    };
    dokter: {
        nama_dokter: string;
    };
    poli_relation: {
        nama_poli: string;
    };
}

interface StatistikInstalasi {
    instalasi: string;
    total: number;
}

interface DashboardProps {
    stats: Stats;
    kunjunganTerbaru: Kunjungan[];
    statistikInstalasi: StatistikInstalasi[];
}

export default function Dashboard({ stats, kunjunganTerbaru, statistikInstalasi }: DashboardProps) {
    const formatRupiah = (amount: number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(amount);
    };

    const getInstalasiColor = (instalasi: string) => {
        switch (instalasi) {
            case 'Rawat Jalan':
                return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300';
            case 'IGD':
                return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
            case 'Rawat Inap':
                return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
            default:
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 p-6">
                {/* Stats Cards */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Pasien</CardTitle>
                            <Users className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.totalPasien}</div>
                            <p className="text-xs text-muted-foreground">Pasien terdaftar</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Dokter</CardTitle>
                            <Stethoscope className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.totalDokter}</div>
                            <p className="text-xs text-muted-foreground">Dokter aktif</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Kunjungan Hari Ini</CardTitle>
                            <Activity className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.kunjunganHariIni}</div>
                            <p className="text-xs text-muted-foreground">Dari {stats.totalKunjungan} total kunjungan</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Kunjungan</CardTitle>
                            <Calendar className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.totalKunjungan}</div>
                            <p className="text-xs text-muted-foreground">Semua kunjungan</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Transaksi</CardTitle>
                            <Receipt className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.totalTransaksi}</div>
                            <p className="text-xs text-muted-foreground">Transaksi billing</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Pendapatan</CardTitle>
                            <TrendingUp className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{formatRupiah(stats.totalPendapatan)}</div>
                            <p className="text-xs text-muted-foreground">Dari semua transaksi</p>
                        </CardContent>
                    </Card>
                </div>

                {/* Bottom Section */}
                <div className="grid gap-4 md:grid-cols-2">
                    {/* Kunjungan Terbaru */}
                    <Card className="md:col-span-1">
                        <CardHeader>
                            <CardTitle>Kunjungan Terbaru</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                {kunjunganTerbaru.length > 0 ? (
                                    kunjunganTerbaru.map((kunjungan) => (
                                        <div
                                            key={kunjungan.id}
                                            className="flex items-start justify-between border-b pb-3 last:border-0"
                                        >
                                            <div className="space-y-1">
                                                <p className="text-sm font-medium leading-none">
                                                    {kunjungan.pasien.nama_pasien}
                                                </p>
                                                <p className="text-xs text-muted-foreground">
                                                    {kunjungan.pasien.no_rm} • {kunjungan.dokter.nama_dokter}
                                                </p>
                                                <p className="text-xs text-muted-foreground">
                                                    {kunjungan.poli_relation.nama_poli}
                                                </p>
                                            </div>
                                            <div className="flex flex-col items-end gap-1">
                                                <Badge className={getInstalasiColor(kunjungan.instalasi)}>
                                                    {kunjungan.instalasi}
                                                </Badge>
                                                <span className="text-xs text-muted-foreground">
                                                    {format(new Date(kunjungan.tanggal_kunjungan), 'dd MMM yyyy', { locale: id })}
                                                </span>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <p className="text-sm text-muted-foreground">Belum ada kunjungan</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    {/* Statistik Instalasi */}
                    <Card className="md:col-span-1">
                        <CardHeader>
                            <CardTitle>Statistik per Instalasi</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                {statistikInstalasi.length > 0 ? (
                                    statistikInstalasi.map((stat) => (
                                        <div key={stat.instalasi} className="flex items-center justify-between">
                                            <div className="flex items-center gap-2">
                                                <Badge className={getInstalasiColor(stat.instalasi)}>
                                                    {stat.instalasi}
                                                </Badge>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-2xl font-bold">{stat.total}</p>
                                                <p className="text-xs text-muted-foreground">kunjungan</p>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <p className="text-sm text-muted-foreground">Belum ada data</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}
