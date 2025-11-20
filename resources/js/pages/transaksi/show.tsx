import TransaksiController from '@/actions/App/Http/Controllers/TransaksiController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type Transaksi } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { ArrowLeft, Pencil, Trash2 } from 'lucide-react';

interface Props {
    transaksi: Transaksi;
}

const breadcrumbs = (transaksi: Transaksi): BreadcrumbItem[] => [
    {
        title: 'Transaksi',
        href: TransaksiController.index().url,
    },
    {
        title: 'Detail Transaksi',
        href: TransaksiController.show(transaksi.id).url,
    },
];

export default function Show({ transaksi }: Props) {
    const handleDelete = () => {
        if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
            router.delete(TransaksiController.destroy(transaksi.id).url);
        }
    };

    const formatCurrency = (value: string | number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(Number(value));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs(transaksi)}>
            <Head title={`Detail Transaksi - ${transaksi.no_transaksi}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Detail Transaksi" />
                    <div className="flex gap-2">
                        <Link href={TransaksiController.edit(transaksi.id).url}>
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

                <div className="mx-auto w-full max-w-4xl space-y-6">
                    <div className="rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                        <div className="space-y-4">
                            <div className="grid grid-cols-2 gap-4">
                                <div className="grid gap-2">
                                    <div className="text-sm font-medium text-muted-foreground">
                                        No. Transaksi
                                    </div>
                                    <div className="font-mono text-lg font-semibold">
                                        {transaksi.no_transaksi}
                                    </div>
                                </div>
                                <div className="grid gap-2">
                                    <div className="text-sm font-medium text-muted-foreground">
                                        No. Registrasi Kunjungan
                                    </div>
                                    <div className="font-mono text-lg">
                                        {transaksi.no_registrasi_kunjungan}
                                    </div>
                                </div>
                            </div>

                            <div className="grid gap-2">
                                <div className="text-sm font-medium text-muted-foreground">
                                    Pasien
                                </div>
                                <div className="text-lg font-semibold">
                                    {transaksi.kunjungan?.pasien?.nama_pasien || '-'}
                                </div>
                            </div>

                            <div className="grid gap-2">
                                <div className="text-sm font-medium text-muted-foreground">
                                    Tanggal Transaksi
                                </div>
                                <div className="text-sm">
                                    {format(new Date(transaksi.created_at), 'dd MMMM yyyy HH:mm')}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                        <h3 className="mb-4 text-lg font-semibold">Detail Tindakan</h3>
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
                                {transaksi.details?.map((detail, index) => (
                                    <TableRow key={detail.id}>
                                        <TableCell>{index + 1}</TableCell>
                                        <TableCell className="font-medium">{detail.nama_tindakan}</TableCell>
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
                                        {formatCurrency(transaksi.total_harga)}
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>

                    <div className="pt-4">
                        <Link href={TransaksiController.index().url}>
                            <Button variant="outline">
                                <ArrowLeft className="mr-2 h-4 w-4" />
                                Kembali
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}

