import KunjunganController from '@/actions/App/Http/Controllers/KunjunganController';
import TransaksiController from '@/actions/App/Http/Controllers/TransaksiController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type Kunjungan } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { ArrowLeft, Eye, Pencil, Plus, Trash2 } from 'lucide-react';

interface Props {
    kunjungan: Kunjungan;
}

const breadcrumbs = (kunjungan: Kunjungan): BreadcrumbItem[] => [
    {
        title: 'Data Kunjungan',
        href: KunjunganController.index().url,
    },
    {
        title: 'Detail Kunjungan',
        href: KunjunganController.show(kunjungan.id).url,
    },
];

export default function Show({ kunjungan }: Props) {
    const handleDelete = () => {
        if (confirm('Apakah Anda yakin ingin menghapus data kunjungan ini?')) {
            router.delete(KunjunganController.destroy(kunjungan.id).url);
        }
    };

    const getInstalasiColor = (instalasi: string) => {
        switch (instalasi) {
            case 'Rawat Jalan':
                return 'bg-blue-500/10 text-blue-500';
            case 'IGD':
                return 'bg-red-500/10 text-red-500';
            case 'Rawat Inap':
                return 'bg-green-500/10 text-green-500';
            default:
                return 'bg-gray-500/10 text-gray-500';
        }
    };

    const formatCurrency = (value: string | number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(Number(value));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs(kunjungan)}>
            <Head title={`Detail Kunjungan - ${kunjungan.no_registrasi_kunjungan}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Detail Data Kunjungan" />
                    <div className="flex gap-2">
                        <Link href={KunjunganController.edit(kunjungan.id).url}>
                            <Button variant="outline">
                                <Pencil className="mr-2 h-4 w-4" />
                                Edit
                            </Button>
                        </Link>
                        <Button variant="destructive" onClick={handleDelete}>
                            <Trash2 className="mr-2 h-4 w-4" />
                            Hapus
                        </Button>
                    </div>
                </div>

                <div className="mx-auto w-full max-w-2xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <div className="space-y-6">
                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                No. Registrasi Kunjungan
                            </div>
                            <div className="font-mono text-lg font-semibold">
                                {kunjungan.no_registrasi_kunjungan}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Pasien
                            </div>
                            <div>
                                <div className="text-lg font-semibold">
                                    {kunjungan.pasien?.nama_pasien}
                                </div>
                                <div className="text-sm text-muted-foreground">
                                    No. RM: {kunjungan.no_rm}
                                </div>
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Tanggal Kunjungan
                            </div>
                            <div className="text-lg">
                                {format(new Date(kunjungan.tanggal_kunjungan), 'dd MMMM yyyy')}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Dokter
                            </div>
                            <div>
                                <div className="text-lg font-semibold">
                                    {kunjungan.dokter?.nama_dokter}
                                </div>
                                <div className="text-sm text-muted-foreground">
                                    {kunjungan.dokter?.kode_dokter} - {kunjungan.dokter?.spesialisasi}
                                </div>
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Poli
                            </div>
                            <div>
                                <div className="text-lg font-semibold">
                                    {kunjungan.poli_relation?.nama_poli}
                                </div>
                                <div className="text-sm text-muted-foreground">
                                    {kunjungan.poli_relation?.kode_poli}
                                    {kunjungan.poli_relation?.lokasi && ` - ${kunjungan.poli_relation.lokasi}`}
                                </div>
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Instalasi
                            </div>
                            <div>
                                <Badge className={getInstalasiColor(kunjungan.instalasi)}>
                                    {kunjungan.instalasi}
                                </Badge>
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Penjamin
                            </div>
                            <div>
                                <div className="text-lg font-semibold">
                                    {kunjungan.penjamin?.nama_penjamin}
                                </div>
                                <div className="text-sm text-muted-foreground">
                                    {kunjungan.penjamin?.kode_penjamin} - {kunjungan.penjamin?.jenis}
                                </div>
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Dibuat pada
                            </div>
                            <div className="text-sm">
                                {format(new Date(kunjungan.created_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Terakhir diupdate
                            </div>
                            <div className="text-sm">
                                {format(new Date(kunjungan.updated_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        {kunjungan.transaksi && (
                            <div className="rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                                <div className="mb-4 flex items-center justify-between">
                                    <h3 className="text-lg font-semibold">Transaksi Billing</h3>
                                    <div className="flex gap-2">
                                        <Link href={TransaksiController.show(kunjungan.transaksi.id).url}>
                                            <Button variant="outline" size="sm">
                                                <Eye className="mr-2 h-4 w-4" />
                                                Lihat Detail
                                            </Button>
                                        </Link>
                                    </div>
                                </div>

                                <div className="mb-4 grid gap-2">
                                    <div className="text-sm font-medium text-muted-foreground">
                                        No. Transaksi
                                    </div>
                                    <div className="font-mono text-lg font-semibold">
                                        {kunjungan.transaksi.no_transaksi}
                                    </div>
                                </div>

                                <Table>
                                    <TableHeader>
                                        <TableRow>
                                            <TableHead>No</TableHead>
                                            <TableHead>Nama Tindakan</TableHead>
                                            <TableHead className="text-right">Harga</TableHead>
                                            <TableHead className="text-center">Qty</TableHead>
                                            <TableHead className="text-right">Subtotal</TableHead>
                                        </TableRow>
                                    </TableHeader>
                                    <TableBody>
                                        {kunjungan.transaksi.details?.map((detail, index) => (
                                            <TableRow key={detail.id}>
                                                <TableCell>{index + 1}</TableCell>
                                                <TableCell className="font-medium">
                                                    {detail.nama_tindakan}
                                                </TableCell>
                                                <TableCell className="text-right">
                                                    {formatCurrency(detail.harga)}
                                                </TableCell>
                                                <TableCell className="text-center">{detail.qty}</TableCell>
                                                <TableCell className="text-right font-semibold">
                                                    {formatCurrency(detail.subtotal)}
                                                </TableCell>
                                            </TableRow>
                                        ))}
                                        <TableRow>
                                            <TableCell colSpan={4} className="text-right font-bold">
                                                Total:
                                            </TableCell>
                                            <TableCell className="text-right text-lg font-bold text-primary">
                                                {formatCurrency(kunjungan.transaksi.total_harga)}
                                            </TableCell>
                                        </TableRow>
                                    </TableBody>
                                </Table>
                            </div>
                        )}

                        {!kunjungan.transaksi && (
                            <div className="rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <h3 className="text-lg font-semibold">Transaksi Billing</h3>
                                        <p className="text-sm text-muted-foreground">
                                            Belum ada transaksi untuk kunjungan ini
                                        </p>
                                    </div>
                                    <Link
                                        href={`${TransaksiController.create().url}?no_registrasi=${kunjungan.no_registrasi_kunjungan}`}
                                    >
                                        <Button>
                                            <Plus className="mr-2 h-4 w-4" />
                                            Buat Transaksi
                                        </Button>
                                    </Link>
                                </div>
                            </div>
                        )}

                        <div className="pt-4">
                            <Link href={KunjunganController.index().url}>
                                <Button variant="outline">
                                    <ArrowLeft className="mr-2 h-4 w-4" />
                                    Kembali
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}

