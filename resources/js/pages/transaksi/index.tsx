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
import { type BreadcrumbItem, type Transaksi, type PaginatedData } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { Eye, Pencil, Plus, Trash2 } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Transaksi',
        href: TransaksiController.index().url,
    },
];

interface Props {
    transaksis: PaginatedData<Transaksi>;
}

export default function Index({ transaksis }: Props) {
    const handleDelete = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
            router.delete(TransaksiController.destroy(id).url);
        }
    };

    const formatCurrency = (value: string | number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(Number(value));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Transaksi" />
            
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Transaksi Billing" />
                    <Link href={TransaksiController.create().url}>
                        <Button>
                            <Plus className="mr-2 h-4 w-4" />
                            Tambah Transaksi
                        </Button>
                    </Link>
                </div>

                <div className="rounded-xl border border-sidebar-border/70 bg-card dark:border-sidebar-border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>No</TableHead>
                                <TableHead>No. Transaksi</TableHead>
                                <TableHead>No. Registrasi</TableHead>
                                <TableHead>Pasien</TableHead>
                                <TableHead>Tanggal</TableHead>
                                <TableHead className="text-right">Total</TableHead>
                                <TableHead className="text-right">Aksi</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {transaksis.data.length === 0 ? (
                                <TableRow>
                                    <TableCell colSpan={7} className="text-center">
                                        Tidak ada data transaksi
                                    </TableCell>
                                </TableRow>
                            ) : (
                                transaksis.data.map((transaksi, index) => (
                                    <TableRow key={transaksi.id}>
                                        <TableCell>{transaksis.from + index}</TableCell>
                                        <TableCell className="font-mono font-semibold">
                                            {transaksi.no_transaksi}
                                        </TableCell>
                                        <TableCell className="font-mono">
                                            {transaksi.no_registrasi_kunjungan}
                                        </TableCell>
                                        <TableCell>
                                            {transaksi.kunjungan?.pasien?.nama_pasien || '-'}
                                        </TableCell>
                                        <TableCell>
                                            {format(new Date(transaksi.created_at), 'dd MMM yyyy')}
                                        </TableCell>
                                        <TableCell className="text-right font-semibold">
                                            {formatCurrency(transaksi.total_harga)}
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <div className="flex justify-end gap-2">
                                                <Link href={TransaksiController.show(transaksi.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Eye className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Link href={TransaksiController.edit(transaksi.id).url}>
                                                    <Button variant="outline" size="sm">
                                                        <Pencil className="h-4 w-4" />
                                                    </Button>
                                                </Link>
                                                <Button
                                                    variant="outline"
                                                    size="sm"
                                                    onClick={() => handleDelete(transaksi.id)}
                                                >
                                                    <Trash2 className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))
                            )}
                        </TableBody>
                    </Table>
                </div>

                {transaksis.last_page > 1 && (
                    <div className="flex items-center justify-between">
                        <div className="text-sm text-muted-foreground">
                            Menampilkan {transaksis.from} - {transaksis.to} dari {transaksis.total} data
                        </div>
                        <div className="flex gap-2">
                            {transaksis.links.map((link, index) => (
                                <Link
                                    key={index}
                                    href={link.url || '#'}
                                    preserveScroll
                                    className={`rounded px-3 py-1 text-sm ${
                                        link.active
                                            ? 'bg-primary text-primary-foreground'
                                            : 'bg-muted hover:bg-muted/80'
                                    } ${!link.url ? 'pointer-events-none opacity-50' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}

