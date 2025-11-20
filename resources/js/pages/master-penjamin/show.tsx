import MasterPenjaminController from '@/actions/App/Http/Controllers/MasterPenjaminController';
import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type MasterPenjamin } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { format } from 'date-fns';
import { ArrowLeft, Pencil, Trash2 } from 'lucide-react';

interface Props {
    penjamin: MasterPenjamin;
}

const breadcrumbs = (penjamin: MasterPenjamin): BreadcrumbItem[] => [
    {
        title: 'Master Penjamin',
        href: MasterPenjaminController.index().url,
    },
    {
        title: 'Detail Penjamin',
        href: MasterPenjaminController.show(penjamin.id).url,
    },
];

export default function Show({ penjamin }: Props) {
    const handleDelete = () => {
        if (confirm('Apakah Anda yakin ingin menghapus data penjamin ini?')) {
            router.delete(MasterPenjaminController.destroy(penjamin.id).url);
        }
    };

    const getJenisColor = (jenis: string) => {
        switch (jenis) {
            case 'BPJS':
                return 'bg-green-500/10 text-green-500';
            case 'Umum':
                return 'bg-blue-500/10 text-blue-500';
            case 'Asuransi':
                return 'bg-purple-500/10 text-purple-500';
            default:
                return 'bg-gray-500/10 text-gray-500';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs(penjamin)}>
            <Head title={`Detail Penjamin - ${penjamin.nama_penjamin}`} />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex items-center justify-between">
                    <Heading title="Detail Data Penjamin" />
                    <div className="flex gap-2">
                        <Link href={MasterPenjaminController.edit(penjamin.id).url}>
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
                                Kode Penjamin
                            </div>
                            <div className="font-mono text-lg font-semibold">
                                {penjamin.kode_penjamin}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Nama Penjamin
                            </div>
                            <div className="text-lg font-semibold">
                                {penjamin.nama_penjamin}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Jenis
                            </div>
                            <div>
                                <Badge className={getJenisColor(penjamin.jenis)}>
                                    {penjamin.jenis}
                                </Badge>
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Dibuat pada
                            </div>
                            <div className="text-sm">
                                {format(new Date(penjamin.created_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="grid gap-2">
                            <div className="text-sm font-medium text-muted-foreground">
                                Terakhir diupdate
                            </div>
                            <div className="text-sm">
                                {format(new Date(penjamin.updated_at), 'dd MMMM yyyy HH:mm')}
                            </div>
                        </div>

                        <div className="pt-4">
                            <Link href={MasterPenjaminController.index().url}>
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

